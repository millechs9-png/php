<?php
require_once 'middleware.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST only']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$name = sanitizeString($input['name'] ?? '');
$email = sanitizeEmail($input['email'] ?? '');
$message = sanitizeString($input['message'] ?? '');
$phone = sanitizeString($input['phone'] ?? '');

if (!$name || !$email || !$message || strlen($message) < 10) {
    http_response_code(400);
    echo json_encode(['error' => 'Valid name, email, message (10+ chars) required']);
    exit;
}

// Log contact form to audit (or send via mailer.php)
auditLog('contact_form', [
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'message' => substr($message, 0, 200) // Truncate for log
]);

// Optional: Send admin email (requires mailer.php config)
echo json_encode([
    'success' => true,
    'message' => 'Thank you! We\'ll respond within 24 hours.'
]);
?>
