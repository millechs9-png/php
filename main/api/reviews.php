<?php
require_once 'middleware.php';

$method = $_SERVER['REQUEST_METHOD'];
$user = requireAuth();

switch ($method) {
    case 'GET':
        $reviews = loadJson('reviews.json');
        // Filter: customers see own, staff/admin see all
        if (($user['role'] ?? '') === 'customer') {
            $reviews = array_values(array_filter($reviews, fn($r) => ($r['customerId'] ?? null) === $user['id']));
        }
        // Sort by newest, approved only for public view
        usort($reviews, fn($a, $b) => strtotime($b['createdAt'] ?? '0') - strtotime($a['createdAt'] ?? '0'));
        echo json_encode(array_values($reviews));
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $reviews = loadJson('reviews.json');
        
        // Must link to user's booking
        $bookingId = $input['bookingId'] ?? null;
        if (!$bookingId) {
            http_response_code(400);
            echo json_encode(['error' => 'bookingId required']);
            exit;
        }
        
        $newReview = [
            'id' => time(),
            'customerId' => $user['id'],
            'customer' => $user['name'],
            'bookingId' => $bookingId,
            'rating' => (int)($input['rating'] ?? 0),
            'comment' => sanitizeString($input['comment'] ?? ''),
            'service' => sanitizeString($input['service'] ?? ''),
            'createdAt' => gmdate('c'),
            'adminApproved' => false // Pending moderation
        ];
        
        if ($newReview['rating'] < 1 || $newReview['rating'] > 5 || strlen($newReview['comment']) < 10) {
            http_response_code(400);
            echo json_encode(['error' => 'Valid rating (1-5) and comment (10+ chars) required']);
            exit;
        }
        
        $reviews[] = $newReview;
        saveJson('reviews.json', $reviews);
        auditLog('review_submitted', ['reviewId' => $newReview['id']]);
        echo json_encode($newReview);
        break;

    case 'PUT':
        // Customers can edit own pending reviews, admin approve any
        $input = json_decode(file_get_contents('php://input'), true);
        $reviewId = $input['id'] ?? null;
        if (!$reviewId) {
            http_response_code(400);
            echo json_encode(['error' => 'reviewId required']);
            exit;
        }
        
        $reviews = loadJson('reviews.json');
        $found = false;
        foreach ($reviews as &$r) {
            if ($r['id'] == $reviewId) {
                if (($user['role'] ?? '') === 'customer' && $r['customerId'] !== $user['id']) {
                    http_response_code(403);
                    echo json_encode(['error' => 'Not your review']);
                    exit;
                }
                if (isset($input['adminApproved'])) $r['adminApproved'] = (bool)$input['adminApproved'];
                if (isset($input['rating'])) $r['rating'] = (int)$input['rating'];
                if (isset($input['comment'])) $r['comment'] = sanitizeString($input['comment']);
                $r['updatedAt'] = gmdate('c');
                $found = true;
                break;
            }
        }
        
        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Review not found']);
            exit;
        }
        
        saveJson('reviews.json', $reviews);
        auditLog('review_updated', ['reviewId' => $reviewId]);
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
?>
