<?php
require_once 'middleware.php';

$sql = "SELECT * FROM cancellations";
$method = $_SERVER['REQUEST_METHOD'];
$user = requireAuth();

switch ($method) {
    case 'GET':
        $cancellations = loadJson('cancellations.json');
        if ($user['role'] === 'customer') {
            $cancellations = array_values(array_filter($cancellations, fn($c) => ($c['customerId'] ?? null) === $user['id']));
        }
        echo json_encode(array_values($cancellations));
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $cancellations = loadJson('cancellations.json');

        $newCancel = [
            'id' => time(),
            'customerId' => $user['id'],
            'customer' => $user['name'],
            'bookingId' => $input['bookingId'] ?? '',
            'reason' => $input['reason'] ?? '',
            'status' => 'pending',
            'createdAt' => gmdate('c')
        ];

        $cancellations[] = $newCancel;
        saveJson('cancellations.json', $cancellations);
        echo json_encode($newCancel);
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $newStatus = $input['status'] ?? null;

        if (!$id || !$newStatus) {
            http_response_code(400);
            echo json_encode(['error' => 'id and status required']);
            exit;
        }

        $cancellations = loadJson('cancellations.json');
        $found = false;
        foreach ($cancellations as &$c) {
            if (($c['id'] ?? null) == $id) {
                $c['status'] = $newStatus;
                $c['updatedAt'] = gmdate('c');
                $found = true;
                break;
            }
        }

        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Cancellation not found']);
            exit;
        }

        saveJson('cancellations.json', $cancellations);
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
