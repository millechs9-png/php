<?php
$page_title = 'Dashboard - AdminHub';
$allowed_roles = ['admin'];
include '../header.php';
?>
<link rel="stylesheet" href="style.css">

	<!-- SIDEBAR -->
	<section id="sidebar">
		<a href="index.php" class="brand">
			<i class='bx bxs-smile'></i>
			<span class="text">Macoy's Straightening Salon</span>
		</a>
		<ul class="side-menu top">
			<li class="active">
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
					<button type="submit" class="search-btn" title="submit"><i class='bx bx-search' ></i></button>
				</div>
			</form>
			<input type="checkbox" id="switch-mode" hidden>
			<label for="switch-mode" class="switch-mode"></label>
			<a href="notification.php" class="notification">
				<i class='bx bxs-bell' ></i>
				<span class="num"><?php echo rand(1,20); ?></span>
			</a>
			<a href="profile.php" class="profile" title="profile">
				<img src="people.png" alt="">
			</a>
		</nav>
		<!-- NAVBAR -->

		<!-- MAIN -->
		<main>
			<div class="head-title">
				<div class="left">
					<h1>Dashboard</h1>
					<ul class="breadcrumb">
						<li>
							<a href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Home</a>
						</li>
					</ul>
				</div>
				<a href="download.php" class="btn-download">
					<i class='bx bxs-cloud-download' ></i>
					<span class="text">Download PDF</span>
				</a>
			</div>

			<ul class="box-info">
				<li>
					<i class='bx bxs-calendar-check' ></i>
					<span class="text">
						<h3 id="newCustomers"><?php echo rand(900,1200); ?></h3>
						<p>New Customers</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-group' ></i>
					<span class="text">
						<h3 id="visitors"><?php echo rand(2500,3000); ?></h3>
						<p>Visitors</p>
					</span>
				</li>
				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3 id="totalSales">$<?php echo rand(2000,3000); ?></h3>
						<p>Total Sales</p>
					</span>
				</li>
			</ul>

			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Recent Customers</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>User</th>
								<th>Date Visited</th>
								<th>Status</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $users = json_decode(file_get_contents('../data/users.json'), true) ?? [];
                            $recent = array_slice($users, 0, 5);
                            foreach ($recent as $user):
                            ?>
							<tr>
								<td>
									<img src="people.png" alt="">
									<p><?php echo htmlspecialchars($user['name']); ?></p>
								</td>
								<td><?php echo date('m-d-Y', strtotime($user['last_visit'] ?? 'now')); ?></td>
								<td><span class="status completed">Completed</span></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<div class="todo">
					<div class="head">
						<h3>Todos</h3>
						<i class='bx bx-plus' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<ul class="todo-list">
						<li class="completed">
							<p>Review weekly sales report</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Update service pricing</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Contact suppliers for inventory</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="completed">
							<p>Schedule staff training</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
						<li class="not-completed">
							<p>Plan marketing campaign</p>
							<i class='bx bx-dots-vertical-rounded' ></i>
						</li>
					</ul>
				</div>
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

<script src="script.js"></script>

<?php include '../footer.php'; ?>
