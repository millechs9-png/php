<?php
require_once 'middleware.php';
require_once 'logger.php';

$user = requireAdmin();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $level = $_GET['level'] ?? 'ALL';
        $limit = min((int)($_GET['limit'] ?? 100), 500);
        $offset = (int)($_GET['offset'] ?? 0);
        $date = $_GET['date'] ?? gmdate('Y-m-d');

        $file = DATA_DIR . 'logs/app-' . preg_replace('/[^0-9-]/', '', $date) . '.log';
        $lines = [];
        if (file_exists($file)) {
            $handle = fopen($file, 'r');
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $entry = json_decode(trim($line), true);
                    if (!$entry) continue;
                    if ($level !== 'ALL' && strtoupper($entry['level'] ?? '') !== strtoupper($level)) continue;
                    $lines[] = $entry;
                }
                fclose($handle);
            }
        }

        $lines = array_reverse($lines);
        $total = count($lines);
        $lines = array_slice($lines, $offset, $limit);

        echo json_encode([
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
            'logs' => $lines
        ]);
        break;

    default:
        http_response_code(405);
        echo json_encode(['error' => 'Method not allowed']);
}

