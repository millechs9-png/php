<?php
$page_title = 'Logout - AdminHub';
$allowed_roles = ['admin'];
include '../header.php';
?>
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="logout.css">
<title>AdminHub</title>

<!-- SIDEBAR -->
<section id="sidebar">
	<a href="index.php" class="brand">
		<i class='bx bxs-smile'></i>
		<span class="text">Macoy's Straightening Salon</span>
	</a>
	<ul class="side-menu top">
		<li>
			<a href="index.php">
				<i class='bx bxs-dashboard' ></i>
				<span class="text">Dashboard</span>
			</a>
		</li>
		<li>
			<a href="mystore.php">
				<i class='bx bxs-shopping-bag-alt' ></i>
				<span class="text">Services</span>
			</a>
		</li>
		<li>
			<a href="analytics.php">
				<i class='bx bxs-doughnut-chart' ></i>
				<span class="text">Analytics</span>
			</a>
		</li>
		<li>
			<a href="feedback.php">
				<i class='bx bxs-message-dots' ></i>
				<span class="text">Feedback</span>
			</a>
		</li>
	</ul>
	<ul class="side-menu">
		<li>
			<a href="settings.php">
				<i class='bx bxs-cog' ></i>
				<span class="text">Settings</span>
			</a>
		</li>
		<li class="active">
			<a href="logout.php" class="logout">
				<i class='bx bxs-log-out-circle' ></i>
				<span class="text">Logout</span>
			</a>
		</li>
	</ul>
</section>
<!-- SIDEBAR -->



<!-- CONTENT -->
<section id="content">
	<!-- NAVBAR -->
	<nav>
		<i class='bx bx-menu' ></i>
		<a href="#" class="nav-link">Categories</a>
		<form action="#">
			<div class="form-input">
				<input type="search" placeholder="Search...">
				<button type="submit" class="search-btn" title="submit"><i class='bx bx-search' ></i></button>
			</div>
		</form>
		<input type="checkbox" id="switch-mode" hidden>
		<label for="switch-mode" class="switch-mode"></label>
		<a href="notification.php" class="notification">
			<i class='bx bxs-bell' ></i>
			<span class="num"><?php echo rand(1,10); ?></span>
		</a>
		<a href="profile.php" class="profile" title="profile">
			<img src="people.png" alt="Profile">
		</a>
	</nav>
	<!-- NAVBAR -->


	<!-- MAIN -->
	<main>
		<div class="head-title">
			<div class="left">
				<h1>Logout</h1>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Dashboard</a>
					</li>
					<li><i class='bx bx-chevron-right' ></i></li>
					<li>
						<a class="active" href="#">Logout</a>
					</li>
				</ul>
			</div>
		</div>

		<div class="logout-container">
			<div class="logout-card">
				<div class="logout-icon">
					<i class='bx bx-log-out-circle' ></i>
				</div>
				<h2>See You Again!</h2>
				<p>Are you sure you want to logout from Macoy's Straightening Salon?</p>
				<div class="logout-buttons">
					<a href="index.php" class="btn-cancel">
						<i class='bx bx-arrow-back' ></i>
						Cancel
					</a>
					<a href="../logout.php" class="btn-logout">
						<i class='bx bx-log-out' ></i>
						Logout
					</a>
				</div>
			</div>

			<div class="session-info">
				<h3>Session Information</h3>
				<div class="info-item">
					<i class='bx bx-user' ></i>
					<span><?php echo htmlspecialchars($_SESSION['name'] ?? 'Admin User'); ?></span>
				</div>
				<div class="info-item">
					<i class='bx bx-time-five' ></i>
					<span>Last Login: <?php echo date('M j, Y g:i A'); ?></span>
				</div>
				<div class="info-item">
					<i class='bx bx-devices' ></i>
					<span>Device: Desktop</span>
				</div>
			</div>
		</div>
	</main>
	<!-- MAIN -->
</section>
<!-- CONTENT -->

<script src="../js/auth.js"></script>
<script src="script.js"></script>
<?php include '../footer.php'; ?>
