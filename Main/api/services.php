<?php
require_once 'middleware.php';

$method = $_SERVER['REQUEST_METHOD'];
$user = requireAuth(); // All access requires login

switch ($method) {
    case 'GET':
        // Everyone can GET services catalog
        $services = loadJson('services.json');
        echo json_encode(array_values($services));
        break;

    case 'PUT':
        // Admin only can update pricing/services
        if (($user['role'] ?? '') !== 'admin') {
            http_response_code(403);
            echo json_encode(['error' => 'Admin only']);
            exit;
        }
        $input = json_decode(file_get_contents('php://input'), true);
        $services = loadJson('services.json');
        
        foreach ($input as $service) {
            $id = $service['id'] ?? null;
            if (!$id) continue;
            foreach ($services as &$s) {
                if ($s['id'] == $id) {
                    $s['name'] = sanitizeString($service['name'] ?? $s['name']);
                    $s['description'] = sanitizeString($service['description'] ?? $s['description']);
                    $s['price'] = (float)($service['price'] ?? $s['price']);
                    $s['duration'] = sanitizeString($service['duration'] ?? $s['duration']);
                    break;
                }
            }
        }
        
        saveJson('services.json', $services);
        auditLog('services_updated', ['services' => array_keys($input)]);
        echo json_encode(['success' => true, 'services' => $services]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}
?>
