<?php
require_once 'middleware.php';

$user = requireStaffOrAdmin();

$method = $_SERVER['REQUEST_METHOD'];

if ($method !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

$bookings = loadJson('bookings.json');
$users = loadJson('users.json');
$walkins = loadJson('walkins.json');
$today = gmdate('Y-m-d');

// Pending bookings count
$pendingCount = count(array_filter($bookings, fn($b) => ($b['status'] ?? '') === 'pending'));

// Today's bookings
$todayBookings = array_values(array_filter($bookings, fn($b) => ($b['date'] ?? '') === $today));

// Recent customers (last 7 days)
$sevenDaysAgo = time() - 7 * 24 * 60 * 60;
$recentCustomers = [];
foreach ($users as $email => $u) {
    $created = strtotime($u['createdAt'] ?? '1970-01-01');
    if ($created >= $sevenDaysAgo) {
        $safe = $u;
        unset($safe['password']);
        $recentCustomers[] = $safe;
    }
}

// Recent walk-ins (last 7 days)
$recentWalkins = array_values(array_filter($walkins, fn($w) => strtotime($w['createdAt'] ?? '1970-01-01') >= $sevenDaysAgo));

// Summary stats
$totalRevenue = array_sum(array_column($bookings, 'totalCost'));
$totalCustomers = count(array_filter($users, fn($u) => ($u['role'] ?? '') === 'customer'));
$totalVisitors = $totalCustomers + count($walkins);

echo json_encode([
    'pendingBookings' => $pendingCount,
    'todayBookings' => $todayBookings,
    'recentCustomers' => $recentCustomers,
    'recentWalkins' => $recentWalkins,
    'totalRevenue' => $totalRevenue,
    'totalCustomers' => $totalCustomers,
    'totalVisitors' => $totalVisitors,
    'todaysDate' => $today,
]);

