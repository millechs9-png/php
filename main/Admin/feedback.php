<?php
$page_title = 'Feedback - AdminHub';
$allowed_roles = ['admin'];
include '../header.php';
?>
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="feedback.css">
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
		<li class="active">
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
			<span class="num"><?php echo rand(1,10); ?></span>
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
				<h1>Feedback</h1>
				<ul class="breadcrumb">
					<li>
						<a href="index.php">Dashboard</a>
					</li>
					<li><i class='bx bx-chevron-right' ></i></li>
					<li>
						<a class="active" href="#">Feedback</a>
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
				<i class='bx bx-message-rounded-dots' ></i>
				<span class="text">
					<h3><?php echo rand(100,200); ?></h3>
					<p>Total Reviews</p>
				</span>
			</li>
			<li>
				<i class='bx bx-happy' ></i>
				<span class="text">
					<h3><?php echo rand(120,180); ?></h3>
					<p>Positive</p>
				</span>
			</li>
			<li>
				<i class='bx bx-sad' ></i>
				<span class="text">
					<h3><?php echo rand(5,25); ?></h3>
					<p>Negative</p>
				</span>
			</li>
		</ul>


		<div class="table-data">
			<div class="order">
				<div class="head">
					<h3>Customer Feedback</h3>
					<i class='bx bx-search' ></i>
					<i class='bx bx-filter' ></i>
				</div>
				<table>
					<thead>
						<tr>
							<th>Customer</th>
							<th>Rating</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<img src="people.png" alt="">
								<p>Jessica Thompson</p>
							</td>
							<td>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
							</td>
							<td><span class="status completed">Responded</span></td>
						</tr>
						<tr>
							<td>
								<img src="people.png" alt="">
								<p>Michael Garcia</p>
							</td>
							<td>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bx-star' ></i>
							</td>
							<td><span class="status completed">Responded</span></td>
						</tr>
						<tr>
							<td>
								<img src="people.png" alt="">
								<p>Amanda Wilson</p>
							</td>
							<td>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
							</td>
							<td><span class="status completed">Responded</span></td>
						</tr>
						<tr>
							<td>
								<img src="people.png" alt="">
								<p>David Kim</p>
							</td>
							<td>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bx-star' ></i>
								<i class='bx bx-star' ></i>
								<i class='bx bx-star' ></i>
							</td>
							<td><span class="status pending">Pending</span></td>
						</tr>
						<tr>
							<td>
								<img src="people.png" alt="">
								<p>Rachel Green</p>
							</td>
							<td>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bxs-star' ></i>
								<i class='bx bx-star' ></i>
							</td>
							<td><span class="status completed">Responded</span></td>
						</tr>
						<tr>
							<td>
								<img src="people.png" alt="">
								<p>Tom Anderson</p>
							</td>
							<td>
								<i class='bx bxs-star' ></i>
								<i class='bx bx-star' ></i>
								<i class='bx bx-star' ></i>
								<i class='bx bx-star' ></i>
								<i class='bx bx-star' ></i>
							</td>
							<td><span class="status process">Escalated</span></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="todo">
				<div class="head">
					<h3>Recent Comments</h3>
					<i class='bx bx-plus' ></i>
					<i class='bx bx-filter' ></i>
				</div>
				<ul class="todo-list">
					<li class="completed">
						<p>"Best hair straightening in town!" - Jessica T.</p>
						<i class='bx bx-dots-vertical-rounded' ></i>
					</li>
					<li class="completed">
						<p>"Great service, highly recommend!" - Michael G.</p>
						<i class='bx bx-dots-vertical-rounded' ></i>
					</li>
					<li class="completed">
						<p>"Love my new hair color!" - Amanda W.</p>
						<i class='bx bx-dots-vertical-rounded' ></i>
					</li>
					<li class="not-completed">
						<p>"Waiting too long for service..." - David K.</p>
						<i class='bx bx-dots-vertical-rounded' ></i>
					</li>
					<li class="completed">
						<p>"Amazing keratin treatment!" - Rachel G.</p>
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
