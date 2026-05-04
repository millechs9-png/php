<?php
$page_title = 'My Reviews - Macoy\'s Straightening Beauty Salon';
$allowed_roles = ['customer'];
include 'header.php';
?>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/myreviews.css">
<link rel="stylesheet" href="css/MediaQuery.css">

		<!-- SIDEBAR -->
		<section id="sidebar">
			<a href="home.php" class="brand">
				<i class='bx bxs-heart-circle'></i>
			</a>
			<ul class="side-menu top">
				<li>
					<a href="home.php">
						<i class='bx bxs-home' ></i>
						<span class="text">Home</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="notification.php">
						<i class='bx bxs-bell' ></i>
						<span class="text">Notification</span>
					</a>
				</li>
                <li>
					<a href="aboutus.php">
						<i class='bx bxs-group' ></i>
						<span class="text">About Us</span>
					</a>
				</li>
				<li>
					<a href="services.php">
						<i class='bx bxs-doughnut-chart' ></i>
						<span class="text">Services</span>
					</a>
				</li>
				<li>
					<a href="portfolio.php">
						<i class='bx bxs-star' ></i>
						<span class="text">Portfolio</span>
					</a>
				</li>
				<li>
					<a href="contact.php">
						<i class='bx bxs-phone' ></i>
						<span class="text">Contact Us</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="reviews.php">
						<i class='bx bxs-message-dots' ></i>
						<span class="text">Reviews</span>
					</a>
				</li>
				<li id="account-li" class="logged-in-only">
					<a href="account.php" class="has-dropdown">
						<i class='bx bxs-user-circle' ></i>
						<span class="text">Account</span>
						<i class='bx bx-chevron-down dropdown-icon'></i>
					</a>
					<ul class="drop-menu">
						<li>
							<a href="account.php">
								<i class='bx bxs-user' ></i>
								<span class="text">Profile</span>
							</a>
						</li>
						<li>
							<a href="mybookings.php">
								<i class='bx bxs-calendar-check' ></i>
								<span class="text">My Bookings</span>
							</a>
						</li>
						<li class="active">
							<a href="myreviews.php">
								<i class='bx bxs-cog' ></i>
								<span class="text">My Reviews</span>
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<ul class="side-menu logged-in-only">
				<li>
					<a href="logout.php" class="logout">
						<i class='bx bxs-log-out-circle' ></i>
						<span class="text">Logout</span>
					</a>
				</li>
			</ul>
			<ul class="side-menu guest-only">
				<li>
					<a href="login.php" class="login">
						<i class='bx bxs-log-in' ></i>
						<span class="text">Log In</span>
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
				<a href="#" class="nav-link">My Account</a>
				<form action="#">
					<div class="form-input">
						<input type="search" placeholder="Search bookings...">
						<button type="submit" class="search-btn"><i class='bx bx-search' ></i></button>
					</div>
				</form>
				<a href="appointment.php" class="appointment-btn">
					<i class='bx bx-calendar-plus'></i>
					<span>Book Now</span>
				</a>
				<input type="checkbox" id="switch-mode" hidden>
				<label for="switch-mode" class="switch-mode"></label>
				<a href="notification.php" class="notification logged-in-only">
					<i class='bx bxs-bell' ></i>
					<span class="num"><?php echo rand(1,10); ?></span>
				</a>
				<a href="account.php" class="profile logged-in-only">
					<img src="img/profile-image.jpg">
				</a>
			</nav>
			<!-- NAVBAR -->

			<main>
                <div class="content-section" id="reviews">
                    <div class="section-header">
                        <h2>My Reviews</h2>
                    </div>
                    <div class="reviews-content" id="reviewsContent">
                        <?php
                        $user_reviews = json_decode(file_get_contents('data/reviews.json'), true) ?? [];
                        $user_id = $_SESSION['id'] ?? 0;
                        $user_reviews = array_filter($user_reviews, fn($r) => $r['user_id'] == $user_id);
                        if (empty($user_reviews)):
                        ?>
                        <p>No reviews yet. <a href="appointment.php">Book services now</a> and leave your feedback!</p>
                        <?php else: ?>
                        <?php foreach ($user_reviews as $review): ?>
                        <div class="review-item">
                            <div class="review-header">
                                <h4><?php echo htmlspecialchars($review['service']); ?></h4>
                                <div class="review-meta">
                                    <?php echo date('M d, Y', strtotime($review['date'])); ?> • Rating: 
                                    <span class="stars"><?php for ($i = 1; $i <= 5; $i++): ?><i class="fas fa-star <?php echo $i <= $review['rating'] ? 'filled' : ''; ?>"></i><?php endfor; ?></span>
                                </div>
                            </div>
                            <p class="review-comment"><?php echo htmlspecialchars($review['comment']); ?></p>
                        </div>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        <a href="appointment.php" class="btn-book">Book a service</a>
                    </div>
                 </div>
			</main>
			<!-- beforefooter  -->
            <div class="beforefooter">
                <div class="box">
                    <div class="logo">Macoy Strengthening Beauty Salon</div>
                    <div class="bf-text">Macoy Manuel Veloso</div>
                    <p class="para">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nostrum ipsam sit magni et
                         consequatur, tenetur ab doloremque totam necessitatibus inventore optio qui? Inventore vel quibusdam
                        exercitationem, nulla asperiores fugiat totam!
                    </p>

                    <div class="bf-text" style="margin-top: 1.5rem;">Follow Us</div>
                    <div class="icons">
                        <a href="https://www.facebook.com/markniel.veloso" target="_blank" class="fa-brands fa-facebook-f"></a>
                        <a href="https://www.google.com" target="_blank" class="fa-brands fa-google"></a>
                    </div>
                </div>

                <div class="box">
                    <div class="bf-text">Quick Links</div>
                    <ul>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="aboutus.php">About</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="portfolio.php">Portfolio</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>

                    <div class="bf-text" style="margin-top: 1rem;">Find Us</div>
                    <div class="address">
                        Paliparan 3 Mabuhay City Subd., Blg. 123, Dasmariñas City, Cavite
                    </div>
                </div>

                <div class="box">
                    <div class="bf-text">Say Hi! </div>
                    <ul class="SayHi">
                        <li><a href="home.php">info@example.com</a></li>
                        <li><a href="aboutus.php">contact@example.com</a></li>
                    </ul>

                    <div class="bf-text">Call Us</div>
                    <ul class="SayHi">
                        <li>Phone :+1 2334325532</li>
                        <li>Toll Free:+1 2334325532</li>
                        </ul>
                    </div>
                </div>

                <!-- footer  -->
                <footer>
                    <div class="fbox">Copyright &copy; 2026 Macoy Strengthening Beauty Salon</div>
                    <div class="fbox">Powered by Macoy Strengthening Beauty Salon</div>
                </footer>
		</section>
		<!-- CONTENT -->
	
<?php include 'footer.php'; ?>
