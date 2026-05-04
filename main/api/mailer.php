<?php


require_once __DIR__ . '/config.php';

// ============================
// SMTP / Mail Config
// ============================
function getMailConfig() {
    $default = [
        'from_name'  => "Macoy's Straightening Salon",
        'from_email' => 'noreply@macoysalon.com',
        'smtp_host'  => '',
        'smtp_port'  => 587,
        'smtp_user'  => '',
        'smtp_pass'  => '',
        'smtp_auth'  => false,
        'smtp_secure'=> 'tls',
        'sms_provider'=> 'mock', // 'twilio' or 'mock'
        'twilio_sid'  => '',
        'twilio_token'=> '',
        'twilio_from' => '',
    ];
    $file = DATA_DIR . 'mail-config.json';
    $saved = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    return array_merge($default, $saved ?: []);
}

function saveMailConfig($config) {
    saveJson('mail-config.json', $config);
}

// ============================
// Template Loader
// ============================
function getNotificationTemplates() {
    return loadJson('notification-templates.json');
}

function renderTemplate($templateId, $variables = []) {
    $templates = getNotificationTemplates();
    $tmpl = $templates[$templateId] ?? null;
    if (!$tmpl) return null;

    $subject = $tmpl['subject'] ?? '';
    $body = $tmpl['body'] ?? '';

    foreach ($variables as $key => $value) {
        $subject = str_replace('{{' . $key . '}}', $value, $subject);
        $body = str_replace('{{' . $key . '}}', $value, $body);
    }

    return ['subject' => $subject, 'body' => $body, 'type' => $tmpl['type'] ?? 'email'];
}

// ============================
// Mail Sender
// ============================
function sendMail($to, $subject, $body, $isHtml = true) {
    $cfg = getMailConfig();
    $from = $cfg['from_email'];
    $fromName = $cfg['from_name'];

    $headers = "From: {$fromName} <{$from}>\r\n";
    $headers .= "Reply-To: {$from}\r\n";
    if ($isHtml) {
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    } else {
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    }

    $result = mail($to, $subject, $body, $headers);

    // Log the attempt
    logNotification('email', $to, $subject, $result ? 'sent' : 'failed');
    return $result;
}

// ============================
// SMS Sender (mock or Twilio-ready)
// ============================
function sendSMS($to, $message) {
    $cfg = getMailConfig();
    $provider = $cfg['sms_provider'] ?? 'mock';

    if ($provider === 'twilio' && !empty($cfg['twilio_sid']) && !empty($cfg['twilio_token'])) {
        // Twilio integration placeholder
        $url = "https://api.twilio.com/2010-04-01/Accounts/{$cfg['twilio_sid']}/Messages.json";
        $data = [
            'From' => $cfg['twilio_from'],
            'To' => $to,
            'Body' => $message
        ];
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_USERPWD, $cfg['twilio_sid'] . ':' . $cfg['twilio_token']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        $success = $httpCode >= 200 && $httpCode < 300;
        logNotification('sms', $to, substr($message, 0, 100), $success ? 'sent' : 'failed', $response);
        return $success;
    }

    // Mock SMS — log only for local dev
    logNotification('sms', $to, substr($message, 0, 100), 'mock-sent');
    return true;
}

// ============================
// Notification Queue / Log
// ============================
function logNotification($type, $recipient, $subject, $status, $response = '') {
    $dir = DATA_DIR . 'notifications/';
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    $file = $dir . 'history.json';

    $history = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    if (!is_array($history)) $history = [];

    $history[] = [
        'id'        => uniqid('notif-', true),
        'type'      => $type,
        'recipient' => $recipient,
        'subject'   => $subject,
        'status'    => $status,
        'response'  => $response,
        'createdAt' => gmdate('c'),
    ];

    // Keep last 5000 entries
    if (count($history) > 5000) {
        $history = array_slice($history, -5000);
    }

    file_put_contents($file, json_encode($history, JSON_PRETTY_PRINT));
}

function getNotificationHistory($limit = 100, $offset = 0) {
    $file = DATA_DIR . 'notifications/history.json';
    $history = file_exists($file) ? json_decode(file_get_contents($file), true) : [];
    if (!is_array($history)) $history = [];
    $history = array_reverse($history);
    return array_slice($history, $offset, $limit);
}

// ============================
// Convenience: Send templated notification
// ============================
function sendNotification($templateId, $toEmail = null, $toPhone = null, $vars = []) {
    $rendered = renderTemplate($templateId, $vars);
    if (!$rendered) return ['success' => false, 'error' => 'Template not found'];

    $results = [];
    if ($toEmail && $rendered['type'] === 'email') {
        $results['email'] = sendMail($toEmail, $rendered['subject'], $rendered['body']);
    }
    if ($toPhone && $rendered['type'] === 'sms') {
        $results['sms'] = sendSMS($toPhone, $rendered['body']);
    }
    return ['success' => true, 'results' => $results];
}

