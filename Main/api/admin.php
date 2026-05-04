<?php
require_once 'middleware.php';

$user = requireAdmin();
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $action = $_GET['action'] ?? 'users';

        if ($action === 'users') {
            $users = loadJson('users.json');
            $safeUsers = [];
            foreach ($users as $email => $u) {
                $safe = $u;
                unset($safe['password']);
                $safeUsers[] = $safe;
            }
            echo json_encode($safeUsers);
        } elseif ($action === 'settings') {
            $settings = loadJson('system-settings.json');
            if (empty($settings)) {
                $settings = [
                    'siteName' => "Macoy's Straightening Salon",
                    'maintenanceMode' => false,
                    'allowRegistration' => true,
                    'defaultStylist' => 'TBD',
                ];
            }
            echo json_encode($settings);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Unknown action']);
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $action = $input['action'] ?? '';

        if ($action === 'updateUser') {
            $email = sanitizeEmail($input['email'] ?? '');
            $users = loadJson('users.json');
            if (!isset($users[$email])) {
                http_response_code(404);
                echo json_encode(['error' => 'User not found']);
                exit;
            }
            if (isset($input['role'])) $users[$email]['role'] = sanitizeString($input['role']);
            if (isset($input['name'])) $users[$email]['name'] = sanitizeString($input['name']);
            if (isset($input['phone'])) $users[$email]['phone'] = sanitizeString($input['phone']);
            if (isset($input['banned'])) $users[$email]['banned'] = (bool)$input['banned'];
            saveJson('users.json', $users);
            auditLog('user_updated', ['target' => $email, 'changes' => array_diff_key($input, ['action'=>1,'email'=>1])]);
            echo json_encode(['success' => true]);
        } elseif ($action === 'settings') {
            $settings = loadJson('system-settings.json');
            $allowed = ['siteName', 'maintenanceMode', 'allowRegistration', 'defaultStylist'];
            foreach ($allowed as $key) {
                if (array_key_exists($key, $input)) {
                    $settings[$key] = is_bool($input[$key]) ? $input[$key] : sanitizeString($input[$key]);
                }
            }
            saveJson('system-settings.json', $settings);
            auditLog('settings_updated', $settings);
            echo json_encode(['success' => true, 'settings' => $settings]);
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Unknown action']);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        $email = sanitizeEmail($input['email'] ?? '');
        if (!$email) {
            http_response_code(400);
            echo json_encode(['error' => 'Email required']);
            exit;
        }
        $users = loadJson('users.json');
        if (!isset($users[$email])) {
            http_response_code(404);
            echo json_encode(['error' => 'User not found']);
            exit;
        }
        unset($users[$email]);
        saveJson('users.json', $users);
        auditLog('user_deleted', ['target' => $email]);
        echo json_encode(['success' => true]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

