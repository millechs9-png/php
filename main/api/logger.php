<?php

require_once __DIR__ . '/config.php';

class SalonLogger {
    private $logDir;
    private $minLevel;
    private $levels = [
        'DEBUG'     => 0,
        'INFO'      => 1,
        'WARNING'   => 2,
        'ERROR'     => 3,
        'CRITICAL'  => 4,
    ];

    public function __construct($minLevel = 'DEBUG') {
        $this->logDir = DATA_DIR . 'logs/';
        $this->minLevel = strtoupper($minLevel);
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0755, true);
        }
    }

    private function shouldLog($level) {
        return ($this->levels[$level] ?? 0) >= ($this->levels[$this->minLevel] ?? 0);
    }

    private function write($level, $message, $context = []) {
        if (!$this->shouldLog($level)) return;

        $file = $this->logDir . 'app-' . gmdate('Y-m-d') . '.log';
        $entry = [
            'timestamp' => gmdate('c'),
            'level' => $level,
            'message' => $message,
            'context' => $context,
            'ip' => $_SERVER['REMOTE_URI'] ?? 'cli',
            'request_uri' => $_SERVER['REQUEST_URI'] ?? 'cli',
            'method' => $_SERVER['REQUEST_METHOD'] ?? 'CLI',
        ];
        $line = json_encode($entry, JSON_UNESCAPED_SLASHES) . "\n";
        file_put_contents($file, $line, FILE_APPEND | LOCK_EX);
    }

    public function debug($message, $context = []) { $this->write('DEBUG', $message, $context); }
    public function info($message, $context = []) { $this->write('INFO', $message, $context); }
    public function warning($message, $context = []) { $this->write('WARNING', $message, $context); }
    public function error($message, $context = []) { $this->write('ERROR', $message, $context); }
    public function critical($message, $context = []) { $this->write('CRITICAL', $message, $context); }

    public function exception(\Throwable $e, $context = []) {
        $this->error($e->getMessage(), array_merge($context, [
            'file' => $e->getFile(),
            'line' => $e->getLine(),
            'trace' => $e->getTraceAsString()
        ]));
    }
}

// Global instance
$GLOBALS['logger'] = new SalonLogger(getenv('LOG_LEVEL') ?: 'DEBUG');

function logger(): SalonLogger {
    return $GLOBALS['logger'];
}

