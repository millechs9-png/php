<?php
require_once 'middleware.php';

$method = $_SERVER['REQUEST_METHOD'];
$user = requireAuth();

switch ($method) {
    case 'GET':
        echo json_encode($user);
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $users = loadJson('users.json');
        $email = $user['email'];
        
        if (!isset($users[$email])) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
            exit;
        }
        
        // Update allowed fields
        if (isset($input['name'])) {
            $users[$email]['name'] = sanitizeString($input['name']);
        }
        if (isset($input['phone'])) {
            $users[$email]['phone'] = sanitizeString($input['phone']);
        }
        if (isset($input['password'])) {
            if (!isset($input['currentPassword']) || !verifyPassword($input['currentPassword'], $users[$email]['password'])) {
                http_response_code(400);
                echo json_encode(['error' => 'Current password incorrect']);
                exit;
            }
            $users[$email]['password'] = hashPassword($input['password']);
        }
        
        saveJson('users.json', $users);
        auditLog('profile_updated', ['email' => $email, 'fields' => array_keys($input)]);
        
        // Return updated user (without password)
        $updatedUser = $users[$email];
        unset($updatedUser['password']);
        echo json_encode($updatedUser);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
?>
