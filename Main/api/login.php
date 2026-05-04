<?php
require_once 'middleware.php';

runMiddleware(['auditAction' => 'login_attempt']);
$sql = "SELECT * FROM users";
$input = sanitizeInputArray(json_decode(file_get_contents('php://input'), true));
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if (!$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'Email and password required']);
    exit;
}

$users = loadJson('users.php');
$user = $users[$email] ?? null;

if (!$user || !verifyPassword($password, $user['password'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials']);
    exit;
}

// Don't send password back
$safeUser = $user;
unset($safeUser['password']);

$token = jwtEncode($safeUser);
echo json_encode(['token' => $token, 'user' => $safeUser]);
