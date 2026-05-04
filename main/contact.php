<?php
$page_title = 'Contact - Macoy\'s Straightening Beauty Salon';
$allowed_roles = ['guest', 'customer'];
include 'header.php';
?>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/contact.css">
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
				<li class="active">
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
				<li class="logged-in-only">
				    <a href="account.php">
					    <i class='bx bxs-user' ></i>
						<span class="text">Profile</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="mybookings.php">
						<i class='bx bxs-calendar-check' ></i>
						<span class="text">My Bookings</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="myreviews.php">
						<i class='bx bxs-cog' ></i>
						<span class="text">My Reviews</span>
					</a>
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
				<a href="#" class="nav-link logged-in-only">My Account</a>
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
				<a href="login.php" class="profile guest-only" title="Guest Profile">
					<i class='bx bxs-user-circle'></i>
				</a>
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
				
				<section class="sectionFirst">
					<h1>Contact Us</h1>

					<!-- transparent Img -->
					<section class="transform-img">
						<img src="img/background180.svg" alt="">
					</section>
				</section>


					<!-- second section  -->
					<section class="FormMap">
						<div class="form">
							<div class="f-head">Get In Touch</div>
							<div class="f-para">Lorem ipsum dolor sit amet, elit. Explicabo?</div>

							<form action="api/contact.php" method="POST">
								<input type="text" name="name" id="" placeholder="Name" required>
								<input type="tel" name="phone" id="" placeholder="Phone" required>
								<input type="email" name="email" id="" placeholder="Email" required>
								<select name="service" id="" title="services">
									<option value="" disabled selected>Select Services</option>
									<option value="Clean Nail Art">Clean Nail Art</option>
									<option value="Hair Styling">Hair Styling</option>
									<option value="Full Body Massage">Full Body Massage</option>
								</select>
								<textarea name="message" id="" cols="30" rows="10" placeholder="Message"></textarea>
								<button type="submit">Send Request</button>
							</form>
						</div>

						<div class="map">
							<iframe title="map" src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d241.61586396221574!2d120.98595889768617!3d14.319922263249278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sBlock%205%20Lot%2010%20mabuhay%20city%20comercial%20paliparan%203%20dasmari%C3%B1as%20cavite!5e0!3m2!1sen!2sph!4v1777315872451!5m2!1sen!2sph" 
							width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
						</div>
					</section>
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

                    <div class="bf-text follow-us">Follow Us</div>
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

                    <div class="bf-text find-us">Find Us</div>
                    <div class="address">
                        Paliparan 3 Mabuhay City Subd., Blg. 123, Dasmariñas City, Cavite
                    </div>
                </div>

                <div class="box">
                    <div class="bf-text">Say Hi! </div>
                    <ul class="SayHi">
                        <li><i class="fa-solid fa-envelope contact-icon"></i><a href="home.php">info@example.com</a></li>
                        <li><i class="fa-solid fa-envelope contact-icon"></i><a href="aboutus.php">contact@example.com</a></li>
                    </ul>

                    <div class="bf-text">Call Us</div>
                    <ul class="SayHi">
                        <li><i class="fa-solid fa-phone contact-icon"></i>Phone :+1 2334325532</li>
                        <li><i class="fa-solid fa-phone contact-icon"></i>Toll Free:+1 2334325532</li>
                        </ul>
                    </div>
            </div>

            <!-- footer  -->
            <footer>
                <div class="fbox">Copyright &copy; 2026 Macoy Strengthening Beauty Salon</div>
                <div class="fbox">Powered by Group 8</div>
            </footer>
		</section>
		<!-- CONTENT -->

<?php include 'footer.php'; ?>
