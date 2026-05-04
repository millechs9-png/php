<?php
$page_title = 'Services - AdminHub';
$allowed_roles = ['admin'];
include '../header.php';
?>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="mystore.css">

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
			<li class="active">
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
			<a href="../notification.php" class="notification">
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
					<h1>Services</h1>
					<ul class="breadcrumb">
						<li>
							<a href="index.php">Dashboard</a>
						</li>
						<li><i class='bx bx-chevron-right' ></i></li>
						<li>
							<a class="active" href="#">Services</a>
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
					<i class='bx bx-package' ></i>
					<span class="text">
						<h3><?php echo count(json_decode(file_get_contents('../data/services.json'), true) ?? []); ?></h3>
						<p>Total Services</p>
					</span>
				</li>

				<li>
					<i class='bx bxs-dollar-circle' ></i>
					<span class="text">
						<h3>$<?php echo rand(3000,4000); ?></h3>
						<p>Revenue Today</p>
					</span>
				</li>
			</ul>


			<div class="table-data">
				<div class="order">
					<div class="head">
						<h3>Services & Pricing</h3>
						<i class='bx bx-search' ></i>
						<i class='bx bx-filter' ></i>
					</div>
					<table>
						<thead>
							<tr>
								<th>Service</th>
								<th>Price</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
                            $services = json_decode(file_get_contents('../data/services.json'), true) ?? [];
                            foreach (array_slice($services, 0, 8) as $service):
                            ?>
							<tr>
								<td>
									<i class='bx bx-scissors' ></i>
									<p><?php echo htmlspecialchars($service['name']); ?></p>
								</td>
								<td><?php echo htmlspecialchars($service['price']); ?></td>
								<td><span class="status completed"><?php echo ucfirst($service['status'] ?? 'Available'); ?></span></td>
								<td>
									<button onclick="editService('<?php echo $service['id']; ?>')">Edit</button>
									<button onclick="toggleService('<?php echo $service['id']; ?>')">Toggle</button>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
					<button class="btn-add-service" onclick="addNewService()">Add New Service</button>
				</div>
				
			</div>
		</main>
		<!-- MAIN -->
	</section>
	<!-- CONTENT -->

<script src="script.js"></script>
<script>
    function editService(id) {
        // AJAX to api/services.php
        alert('Edit service ' + id);
    }
    function toggleService(id) {
        // AJAX toggle
        fetch('../api/services.php', {
            method: 'POST',
            body: JSON.stringify({action: 'toggle', id})
        }).then(() => location.reload());
    }
    function addNewService() {
        // Modal for new service
    }
</script>

<?php include '../footer.php'; ?>
