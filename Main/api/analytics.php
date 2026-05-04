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
$cancellations = loadJson('cancellations.json');
$users = loadJson('users.json');
$walkins = loadJson('walkins.json');

$now = time();
$today = gmdate('Y-m-d');
$thisMonth = gmdate('Y-m');
$lastMonth = gmdate('Y-m', strtotime('-1 month'));

// Total metrics
$totalBookings = count($bookings);
$totalRevenue = array_sum(array_column($bookings, 'totalCost'));
$totalCustomers = count(array_filter($users, fn($u) => ($u['role'] ?? '') === 'customer'));
$totalWalkins = count($walkins);
$totalCancellations = count($cancellations);

// Pending bookings
$pendingBookings = count(array_filter($bookings, fn($b) => ($b['status'] ?? '') === 'pending'));

// Today's bookings
$todayBookings = array_filter($bookings, fn($b) => ($b['date'] ?? '') === $today);

// New customers this month
$newCustomersThisMonth = 0;
foreach ($users as $u) {
    $created = $u['createdAt'] ?? '';
    if (strpos($created, $thisMonth) === 0) $newCustomersThisMonth++;
}

// Revenue this month / last month
$revenueThisMonth = 0;
$revenueLastMonth = 0;
$monthlyRevenue = [];
$monthlyBookings = [];

foreach ($bookings as $b) {
    $cost = (float)($b['totalCost'] ?? 0);
    $created = $b['createdAt'] ?? '';
    $month = substr($created, 0, 7);
    if ($month) {
        $monthlyRevenue[$month] = ($monthlyRevenue[$month] ?? 0) + $cost;
        $monthlyBookings[$month] = ($monthlyBookings[$month] ?? 0) + 1;
    }
    if (strpos($created, $thisMonth) === 0) $revenueThisMonth += $cost;
    if (strpos($created, $lastMonth) === 0) $revenueLastMonth += $cost;
}

$growthRate = 0;
if ($revenueLastMonth > 0) {
    $growthRate = round((($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100, 2);
}

// Service popularity
$serviceCounts = [];
foreach ($bookings as $b) {
    $services = $b['services'] ?? [];
    if (is_array($services)) {
        foreach ($services as $s) {
            $name = is_array($s) ? ($s['name'] ?? 'Unknown') : $s;
            $serviceCounts[$name] = ($serviceCounts[$name] ?? 0) + 1;
        }
    } else {
        $svc = $b['service'] ?? 'Unknown';
        $serviceCounts[$svc] = ($serviceCounts[$svc] ?? 0) + 1;
    }
}
arsort($serviceCounts);
$topServices = [];
foreach (array_slice($serviceCounts, 0, 10, true) as $name => $count) {
    $topServices[] = ['name' => $name, 'count' => $count];
}

// Recent customers (last 30 days)
$recentCustomers = [];
foreach ($users as $email => $u) {
    $created = $u['createdAt'] ?? '';
    $createdTime = strtotime($created);
    if ($createdTime && ($now - $createdTime) <= 30 * 24 * 60 * 60) {
        $c = $u;
        unset($c['password']);
        $recentCustomers[] = $c;
    }
}

// Cancellation rate
$cancellationRate = $totalBookings > 0 ? round(($totalCancellations / $totalBookings) * 100, 2) : 0;

// Monthly revenue list for charts
$monthlyRevenueList = [];
ksort($monthlyRevenue);
foreach ($monthlyRevenue as $month => $amount) {
    $prev = null;
    $keys = array_keys($monthlyRevenue);
    $idx = array_search($month, $keys);
    if ($idx > 0) $prev = $monthlyRevenue[$keys[$idx - 1]];
    $growth = 0;
    if ($prev && $prev > 0) $growth = round((($amount - $prev) / $prev) * 100, 2);
    $monthlyRevenueList[] = ['month' => $month, 'revenue' => $amount, 'growth' => $growth];
}

echo json_encode([
    'totalBookings' => $totalBookings,
    'totalRevenue' => $totalRevenue,
    'totalCustomers' => $totalCustomers,
    'totalWalkins' => $totalWalkins,
    'totalCancellations' => $totalCancellations,
    'pendingBookings' => $pendingBookings,
    'todayBookings' => count($todayBookings),
    'newCustomersThisMonth' => $newCustomersThisMonth,
    'revenueThisMonth' => $revenueThisMonth,
    'revenueLastMonth' => $revenueLastMonth,
    'growthRate' => $growthRate,
    'cancellationRate' => $cancellationRate,
    'topServices' => $topServices,
    'recentCustomers' => $recentCustomers,
    'monthlyRevenue' => $monthlyRevenueList,
    'monthlyBookings' => $monthlyBookings,
]);

