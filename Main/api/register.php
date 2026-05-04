<?php
require_once 'middleware.php';

runMiddleware(['auditAction' => 'register_attempt']);

$input = sanitizeInputArray(json_decode(file_get_contents('php://input'), true));
$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$password = $input['password'] ?? '';

if (!$name || !$email || !$password) {
    http_response_code(400);
    echo json_encode(['error' => 'All fields required']);
    exit;
}

$users = loadJson('users.json');
if (isset($users[$email])) {
    http_response_code(400);
    echo json_encode(['error' => 'User already exists']);
    exit;
}

$newUser = [
    'id' => time(),
    'name' => $name,
    'email' => $email,
    'password' => hashPassword($password),
    'role' => 'customer'
];

$users[$email] = $newUser;
saveJson('users.json', $users);

// Don't send password back
$safeUser = $newUser;
unset($safeUser['password']);

$token = jwtEncode($safeUser);
echo json_encode(['token' => $token, 'user' => $safeUser]);
