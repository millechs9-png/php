<?php
require_once 'middleware.php';

$sql = "SELECT * FROM bookings";
$method = $_SERVER['REQUEST_METHOD'];
$user = requireAuth();

switch ($method) {
    case 'GET':
        $bookings = loadJson('bookings.json');
        // If customer, filter by their id
        if ($user['role'] === 'customer') {
            $bookings = array_values(array_filter($bookings, fn($b) => ($b['customerId'] ?? null) === $user['id']));
        }
        echo json_encode(array_values($bookings));
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $bookings = loadJson('bookings.json');

        $newBooking = [
            'id' => time(),
            'customerId' => $user['id'],
            'customer' => $user['name'],
            'date' => $input['date'] ?? '',
            'time' => $input['time'] ?? '',
            'service' => $input['service'] ?? '',
            'services' => $input['services'] ?? [],
            'stylist' => $input['stylist'] ?? 'TBD',
            'status' => 'pending',
            'totalCost' => $input['totalCost'] ?? 0,
            'bookingId' => 'BK-' . time(),
            'createdAt' => gmdate('c')
        ];

        $bookings[] = $newBooking;
        saveJson('bookings.json', $bookings);
        echo json_encode($newBooking);
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $bookingId = $input['bookingId'] ?? ($input['id'] ?? null);
        $newStatus = $input['status'] ?? null;

        if (!$bookingId || !$newStatus) {
            http_response_code(400);
            echo json_encode(['error' => 'bookingId and status required']);
            exit;
        }

        $bookings = loadJson('bookings.json');
        $found = false;
        foreach ($bookings as &$b) {
            if (($b['bookingId'] ?? null) === $bookingId || ($b['id'] ?? null) == $bookingId) {
                // Customers can only cancel their own pending bookings
                if ($user['role'] === 'customer') {
                    if ($b['customerId'] !== $user['id'] || $newStatus !== 'cancelled') {
                        http_response_code(403);
                        echo json_encode(['error' => 'Not allowed']);
                        exit;
                    }
                }
                $b['status'] = $newStatus;
                $b['updatedAt'] = gmdate('c');
                $found = true;
                break;
            }
        }

        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Booking not found']);
            exit;
        }

        saveJson('bookings.json', $bookings);
        echo json_encode(['success' => true]);
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        $bookingId = $input['bookingId'] ?? ($input['id'] ?? null);

        $bookings = loadJson('bookings.json');
        $originalCount = count($bookings);

        // Only allow customers to delete their own, staff/admin can delete any
        $bookings = array_values(array_filter($bookings, function($b) use ($bookingId, $user) {
            $match = ($b['bookingId'] ?? null) === $bookingId || ($b['id'] ?? null) == $bookingId;
            if (!$match) return true;
            if ($user['role'] === 'customer' && $b['customerId'] !== $user['id']) return true;
            return false;
        }));

        if (count($bookings) === $originalCount) {
            http_response_code(404);
            echo json_encode(['error' => 'Booking not found']);
            exit;
        }

        saveJson('bookings.json', $bookings);
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
