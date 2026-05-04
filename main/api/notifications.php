<?php
require_once __DIR__ . '/middleware.php';
require_once __DIR__ . '/mailer.php';

$user = requireAuth();
$method = $_SERVER['REQUEST_METHOD'];

// Defensive guards in case linter/runtime claims functions are missing
if (!function_exists('getNotificationHistory') || !function_exists('sendNotification')) {
    http_response_code(500);
    echo json_encode(['error' => 'Notification functions not loaded. Check mailer.php.']);
    exit;
}

switch ($method) {
    case 'GET':
        // Admin sees all, staff sees recent, customers see own
        $history = getNotificationHistory(
            (int)($_GET['limit'] ?? 50),
            (int)($_GET['offset'] ?? 0)
        );
        if ($user['role'] === 'customer') {
            $history = array_values(array_filter($history, fn($h) => ($h['recipient'] ?? '') === ($user['email'] ?? '')));
        }
        echo json_encode($history);
        break;

    case 'POST':
        // Only admin/staff can send notifications
        if ($user['role'] === 'customer') {
            http_response_code(403);
            echo json_encode(['error' => 'Staff or Admin only']);
            exit;
        }

        $input = json_decode(file_get_contents('php://input'), true);
        $templateId = $input['template'] ?? '';
        $toEmail = $input['toEmail'] ?? null;
        $toPhone = $input['toPhone'] ?? null;
        $vars = $input['vars'] ?? [];

        if (!$templateId || (!$toEmail && !$toPhone)) {
            http_response_code(400);
            echo json_encode(['error' => 'template and at least one recipient required']);
            exit;
        }

        $result = sendNotification($templateId, $toEmail, $toPhone, $vars);
        auditLog('notification_sent', ['template' => $templateId, 'toEmail' => $toEmail, 'toPhone' => $toPhone]);
        echo json_encode($result);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

