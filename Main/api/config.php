<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Paths
define('DATA_DIR', __DIR__ . '/../data/');
define('JWT_SECRET', 'salon-super-secret-key-2024-change-in-prod');

// Ensure data directory exists
if (!is_dir(DATA_DIR)) {
    mkdir(DATA_DIR, 0755, true);
}

// JSON helpers
function loadJson($filename) {
    $path = DATA_DIR . $filename;
    if (!file_exists($path)) return [];
    $content = file_get_contents($path);
    return json_decode($content, true) ?: [];
}

function saveJson($filename, $data) {
    $path = DATA_DIR . $filename;
    file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
}

// JWT helpers (HS256)
function base64UrlEncode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function base64UrlDecode($data) {
    return base64_decode(strtr($data, '-_', '+/') . str_repeat('=', 3 - (3 + strlen($data)) % 4));
}

function jwtEncode($payload) {
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload['iat'] = time();
    $payload['exp'] = time() + (7 * 24 * 60 * 60); // 7 days
    $payloadJson = json_encode($payload);
    $base64Header = base64UrlEncode($header);
    $base64Payload = base64UrlEncode($payloadJson);
    $signature = hash_hmac('sha256', "$base64Header.$base64Payload", JWT_SECRET, true);
    $base64Signature = base64UrlEncode($signature);
    return "$base64Header.$base64Payload.$base64Signature";
}

function jwtDecode($token) {
    $parts = explode('.', $token);
    if (count($parts) !== 3) return null;
    $payload = json_decode(base64UrlDecode($parts[1]), true);
    if (!$payload || !isset($payload['exp']) || $payload['exp'] < time()) return null;
    $signature = hash_hmac('sha256', "$parts[0].$parts[1]", JWT_SECRET, true);
    if (!hash_equals(base64UrlEncode($signature), $parts[2])) return null;
    return $payload;
}

function getBearerToken() {
    $headers = getallheaders();
    $auth = $headers['Authorization'] ?? '';
    if (strpos($auth, 'Bearer ') === 0) {
        return substr($auth, 7);
    }
    return null;
}

function requireAuth() {
    $token = getBearerToken();
    if (!$token) {
        http_response_code(401);
        echo json_encode(['error' => 'Access token required']);
        exit;
    }
    $user = jwtDecode($token);
    if (!$user) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid token']);
        exit;
    }
    return $user;
}

// Password helpers
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Auto-wire logger if available
$loggerPath = __DIR__ . '/logger.php';
if (file_exists($loggerPath)) {
    require_once $loggerPath;
}

