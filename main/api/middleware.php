<?php
/**
 * Security & Middleware Layer
 * Includes: rate limiting, input sanitization, security headers,
 * CORS middleware, IP blocklist, audit logging.
 */

require_once __DIR__ . '/config.php';

// ============================
// Rate Limiting (file-based)
// ============================
function rateLimit($key = null, $maxRequests = 60, $windowSeconds = 60) {
    $key = $key ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $safeKey = preg_replace('/[^a-zA-Z0-9._-]/', '', $key);
    $dir = DATA_DIR . 'rate-limit/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $file = $dir . $safeKey . '.json';

    $now = time();
    $data = ['count' => 0, 'windowStart' => $now];
    if (file_exists($file)) {
        $data = json_decode(file_get_contents($file), true) ?: $data;
    }

    if ($now - $data['windowStart'] > $windowSeconds) {
        $data = ['count' => 0, 'windowStart' => $now];
    }

    $data['count']++;
    file_put_contents($file, json_encode($data));

    if ($data['count'] > $maxRequests) {
        http_response_code(429);
        echo json_encode(['error' => 'Rate limit exceeded. Try again later.']);
        exit;
    }
}

// ============================
// Input Sanitization
// ============================
function sanitizeString($str) {
    return htmlspecialchars(strip_tags(trim($str)), ENT_QUOTES, 'UTF-8');
}

function sanitizeEmail($email) {
    return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
}

function sanitizeInputArray($input) {
    if (!is_array($input)) return sanitizeString((string)$input);
    $clean = [];
    foreach ($input as $k => $v) {
        $clean[sanitizeString($k)] = is_array($v) ? sanitizeInputArray($v) : sanitizeString((string)$v);
    }
    return $clean;
}

// ============================
// Security Headers
// ============================
function applySecurityHeaders() {
    header('X-Frame-Options: DENY');
    header('X-Content-Type-Options: nosniff');
    header('Referrer-Policy: strict-origin-when-cross-origin');
    header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://unpkg.com; style-src 'self' 'unsafe-inline' https://unpkg.com; img-src 'self' data:; font-src 'self' https://unpkg.com; connect-src 'self';");
    header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
}

// ============================
// CORS Middleware
// ============================
function applyCors($allowedOrigins = ['*']) {
    $origin = $_SERVER['HTTP_ORIGIN'] ?? '*';
    if (in_array('*', $allowedOrigins) || in_array($origin, $allowedOrigins)) {
        header("Access-Control-Allow-Origin: $origin");
    }
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, Authorization');
    header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
        http_response_code(200);
        exit;
    }
}

// ============================
// IP Blocklist / Allowlist
// ============================
function checkIpBlocklist() {
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    $blocklistFile = DATA_DIR . 'ip-blocklist.json';
    $blocklist = file_exists($blocklistFile) ? loadJson('ip-blocklist.json') : [];
    if (in_array($ip, $blocklist)) {
        http_response_code(403);
        echo json_encode(['error' => 'Access denied.']);
        exit;
    }
}

function checkIpAllowlist($allowed = []) {
    if (empty($allowed)) return;
    $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    if (!in_array($ip, $allowed)) {
        http_response_code(403);
        echo json_encode(['error' => 'Access denied.']);
        exit;
    }
}

// ============================
// Audit Logging
// ============================
function auditLog($action, $details = []) {
    $dir = DATA_DIR . 'logs/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $file = $dir . 'audit-' . gmdate('Y-m-d') . '.log';

    $token = getBearerToken();
    $actor = 'guest';
    if ($token) {
        $payload = jwtDecode($token);
        $actor = $payload['email'] ?? ($payload['name'] ?? 'unknown');
    }

    $entry = [
        'timestamp' => gmdate('c'),
        'actor' => $actor,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'action' => $action,
        'details' => $details
    ];

    $line = json_encode($entry) . "\n";
    file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
}

// ============================
// Unified Middleware Runner
// ============================
function runMiddleware($options = []) {
    // Default options
    $opts = array_merge([
        'cors' => true,
        'securityHeaders' => true,
        'rateLimit' => true,
        'rateMax' => 120,
        'rateWindow' => 60,
        'blocklist' => true,
        'allowlist' => [],
        'auditAction' => null,
    ], $options);

    if ($opts['cors']) applyCors();
    if ($opts['securityHeaders']) applySecurityHeaders();
    if ($opts['blocklist']) checkIpBlocklist();
    if (!empty($opts['allowlist'])) checkIpAllowlist($opts['allowlist']);
    if ($opts['rateLimit']) rateLimit(null, $opts['rateMax'], $opts['rateWindow']);
    if ($opts['auditAction']) auditLog($opts['auditAction'], ['method' => $_SERVER['REQUEST_METHOD'], 'uri' => $_SERVER['REQUEST_URI']]);
}

// ============================
// Global Error Handler
// ============================
set_exception_handler(function (Throwable $e) {
    $log = '';
    if (function_exists('logger')) {
        logger()->exception($e);
    } else {
        error_log('[UNCAUGHT EXCEPTION] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
    }
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error', 'message' => $e->getMessage()]);
    exit;
});

set_error_handler(function ($severity, $message, $file, $line) {
    if (function_exists('logger')) {
        logger()->error('PHP Error', ['severity' => $severity, 'message' => $message, 'file' => $file, 'line' => $line]);
    }
    return true;
});

// ============================
// Admin-only wrapper
// ============================
function requireAdmin() {
    $user = requireAuth();
    if (($user['role'] ?? '') !== 'admin') {
        http_response_code(403);
        echo json_encode(['error' => 'Admin access required']);
        exit;
    }
    return $user;
}

// ============================
// Staff or Admin wrapper
// ============================
function requireStaffOrAdmin() {
    $user = requireAuth();
    $role = $user['role'] ?? '';
    if ($role !== 'admin' && $role !== 'staff') {
        http_response_code(403);
        echo json_encode(['error' => 'Staff or Admin access required']);
        exit;
    }
    return $user;
}

