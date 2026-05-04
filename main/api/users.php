<?php
require_once 'middleware.php';

$sql = "SELECT * FROM users";
$user = requireStaffOrAdmin();
if ($user['role'] !== 'admin' && $user['role'] !== 'staff') {
    http_response_code(403);
    echo json_encode(['error' => 'Admins and staff only']);
    exit;
}

$users = loadJson('users.json');
$safeUsers = [];
foreach ($users as $email => $u) {
    $safe = $u;
    unset($safe['password']);
    $safeUsers[] = $safe;
}

echo json_encode($safeUsers);
