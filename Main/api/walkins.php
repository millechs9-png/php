<?php
require_once 'middleware.php';

$sql = "SELECT * FROM walkins";
$method = $_SERVER['REQUEST_METHOD'];
$user = requireAuth();

switch ($method) {
    case 'GET':
        $walkins = loadJson('walkins.json');
        echo json_encode(array_values($walkins));
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        $walkins = loadJson('walkins.json');

        $newWalkin = [
            'id' => time(),
            'customer' => $input['customer'] ?? '',
            'phone' => $input['phone'] ?? '',
            'email' => $input['email'] ?? '',
            'service' => $input['service'] ?? '',
            'notes' => $input['notes'] ?? '',
            'status' => 'pending',
            'createdAt' => gmdate('c')
        ];

        $walkins[] = $newWalkin;
        saveJson('walkins.json', $walkins);
        echo json_encode($newWalkin);
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

        $walkins = loadJson('walkins.json');
        $found = false;
        foreach ($walkins as &$w) {
            if (($w['id'] ?? null) == $id) {
                $w['status'] = $newStatus;
                $w['updatedAt'] = gmdate('c');
                $found = true;
                break;
            }
        }

        if (!$found) {
            http_response_code(404);
            echo json_encode(['error' => 'Walk-in not found']);
            exit;
        }

        saveJson('walkins.json', $walkins);
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
