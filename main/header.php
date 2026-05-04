<?php
session_start();
require_once 'api/config.php'; // Assume exists for DB/config

// Role-based access - customize per page
$allowed_roles = ['guest', 'customer', 'staff', 'admin']; // Default
if (!isset($_SESSION['role']) || !in_array($_SESSION['role'], $allowed_roles)) {
    header('Location: login.php');
    exit();
}
$page_title = 'Macoy\'s Straightening Salon'; // Default, override in pages
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($page_title ?? $page_title); ?></title>
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Page-specific CSS will be included in pages -->
    <script src="https://kit.fontawesome.com/7a6c6b42a6.js" crossorigin="anonymous"></script>
</head>
<body>
