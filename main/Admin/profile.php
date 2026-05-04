<?php
$page_title = 'Profile - AdminHub';
$allowed_roles = ['admin'];
include '../header.php';
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="profile.css">

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="../home.php" class="brand">
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
			<li>
				<a href="../logout.php" class="logout">
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
					<button type="submit" class="search-btn"><i class='bx bx-search' title="submit"></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="notification.php" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num"><?php echo rand(1,20); ?></span>
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
					<h1>Profile</h1>
					<ul class="breadcrumb">
						<li>
							<a href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Profile</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="profile-header">
				<img src="people.png" alt="Profile" class="profile-avatar">
				<div class="profile-info">
					<h2><?php echo htmlspecialchars($_SESSION['name'] ?? 'Mark Neil M. Veloso'); ?></h2>
					<p><?php echo htmlspecialchars($_SESSION['email'] ?? 'macoy@salon.com'); ?></p>
					<p><?php echo htmlspecialchars($_SESSION['phone'] ?? '+1 234 567 8900'); ?></p>
					<span class="role">Salon Owner</span>
				</div>
			</div>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Account Details</h3>
					</div>
					<table>
						<tbody>
							<tr>
								<td>Full Name</td>
								<td><?php echo htmlspecialchars($_SESSION['name'] ?? 'Mark Neil M. Veloso'); ?></td>
							</tr>
							<tr>
								<td>Email Address</td>
								<td><?php echo htmlspecialchars($_SESSION['email'] ?? 'macoy@salon.com'); ?></td>
							</tr>
							<tr>
								<td>Phone Number</td>
								<td><?php echo htmlspecialchars($_SESSION['phone'] ?? '+1 234 567 8900'); ?></td>
							</tr>
							<tr>
								<td>Address</td>
								<td>Mabuhay City, Paliparan 3 Dasmarinas Cavite</td>
							</tr>
							<tr>
								<td>Role</td>
								<td>Salon Owner</td>
							</tr>
							<tr>
								<td>Member Since</td>
								<td>January 2023</td>
							</tr>
						</tbody>
					</table>
					<form action="../api/admin.php" method="POST" class="update-profile-form">
						<button type="submit" name="update_profile">Update Profile</button>
					</form>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

<script src="script.js"></script>

<?php include '../footer.php'; ?>
