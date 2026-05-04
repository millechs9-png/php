<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
		<link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/MediaQuery.css">
		<title>CustomerHub - Macoy's Strengthening Beauty Salon</title>
        <script src="https://kit.fontawesome.com/7a6c6b42a6.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php /* Converted from home.html - Fixed version */ ?>
		<!-- SIDEBAR -->
		<section id="sidebar">
			<a href="home.php" class="brand">
				<img src="img/logo.png" alt="Macoy's Strengthening Beauty Salon Logo" class="logo-image">
			</a>
            <ul class="side-menu top">
				<li class="active">
					<a href="home.php">
						<i class='bx bxs-home'></i>
						<span class="text">Home</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="contact.php">
						<i class='bx bxs-bell'></i>
						<span class="text">Notifications</span>
					</a>
				</li>
                <li>
					<a href="aboutus.php">
						<i class='bx bxs-group'></i>
						<span class="text">About Us</span>
					</a>
				</li>
				<li>
					<a href="appointment.php">
						<i class='bx bxs-doughnut-chart'></i>
						<span class="text">Services</span>
					</a>
				</li>
				<li>
					<a href="aboutus.php">
						<i class='bx bxs-star'></i>
						<span class="text">Portfolio</span>
					</a>
				</li>
				<li>
					<a href="contact.php">
						<i class='bx bxs-phone'></i>
						<span class="text">Contact Us</span>
					</a>
				</li>
				<li>
					<a href="reviews.html">
						<i class='bx bxs-message-dots'></i>
						<span class="text">Reviews</span>
					</a>
				</li>
				<li class="logged-in-only">
				    <a href="account.php">
					    <i class='bx bxs-user'></i>
						<span class="text">My Profile</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="mybookings.php">
						<i class='bx bxs-calendar-check'></i>
						<span class="text">My Bookings</span>
					</a>
				</li>
				<li class="logged-in-only">
					<a href="reviews.html">
						<i class='bx bxs-cog'></i>
						<span class="text">My Reviews</span>
					</a>
				</li>
			</ul>
			<ul class="side-menu logged-in-only">
				<li>
					<a href="logout.php" class="logout">
						<i class='bx bxs-log-out-circle'></i>
						<span class="text">Logout</span>
					</a>
				</li>
			</ul>
			<ul class="side-menu guest-only">
				<li>
					<a href="login.php" class="login">
						<i class='bx bxs-log-in'></i>
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
				<i class='bx bx-menu'></i>
				<a href="#" class="nav-link logged-in-only">My Account</a>
				<form action="#">
					<div class="form-input">
						<input type="search" placeholder="Search bookings...">
						<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
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
				<a href="contact.php" class="notification logged-in-only">
					<i class='bx bxs-bell'></i>
					<span class="num">3</span>
				</a>                                   
				<a href="account.php" class="profile logged-in-only">
					<img src="img/profile-image.jpg" alt="User Profile">
				</a>
			</nav>
			<!-- NAVBAR -->

			<main>
                <section class="sectionFirst">
                    <div class="frontPage">
                        <h2 class="heading">Macoy's Strengthening Beauty Salon</h2>
                        <p class="para">Step into comfort and leave with confidence—reserve your appointment now!</p>
                        <div class="btn">
                            <a href="appointment.php">Get Your Style</a>
                            <a href="appointment.php" class="book-now-btn">Book Now</a>
                        </div>
                    </div>

                     <!-- transparent Img -->
                    <section class="transform-img">
                        <img src="img/background180.svg" alt="Background graphic">
                    </section>
                </section>

                <!-- section second  -->
                <section class="sectionSecond">
                    <div class="fourIMG">
                        <img src="img/home-model1.jpg" alt="Model 1">
                        <img src="img/home-model2.jpg" alt="Model 2">
                        <img src="img/home-model3.jpg" alt="Model 3">
                        <img src="img/home-model4.jpg" alt="Model 4">
                    </div>

                    <div class="textInfo">
                        <div class="greet">Welcome To</div>
                        <h2 class="title">Macoy's Strengthening Beauty Salon</h2>
                        <p class="para">Where beauty and comfort come together. Enjoy smooth hair straightening, stylish hairstyles, 
                            and makeup services perfect for everyday looks or special occasions. Relax with our pedicure and foot care, 
                            and enhance your beauty with expertly shaped eyebrow tattoo and enhancement services. Comfort starts here—confidence goes with you!
                        </p>
                        <a href="aboutus.php" class="btn">Know More</a>
                    </div>
                </section>

                <!-- section three  -->
                <section class="sectionThree">
                    <h2>Services For Every Occasion</h2>
                    <p>Special services for weddings, events, and more.</p>

                    <div class="servicesBox">
                        <div class="box">
                            <h2>Hair Cutting & Styling</h2>
                            <p>This service includes trimming, shaping, and styling hair to match clients' preferences, 
                                with options ranging from everyday cuts to formal updos.
                            </p>
                        </div>
                        <div class="box">
                            <h2>Nail Care</h2>
                            <p>Manicures and pedicures shape nails, care for cuticles, and may include polish, extensions, 
                                or treatments to address foot and nail issues.
                            </p>
                        </div>
                        <div class="box">
                            <h2>Hair Coloring & Treatments</h2>
                            <p>Services cover everything from all-over color and highlights to deep conditioning, keratin smoothing, 
                                and scalp treatments for hair health and style.
                            </p>
                        </div>
                        <div class="box">
                            <h2>Photo Makeup</h2>
                            <p>Professional makeup for photoshoots and special events.</p>
                        </div>
                    </div>
                </section>

                    <!-- discount section  -->
                <section class="DiscountSection">
                    <div class="img">
                        <img src="img/25off.png" alt="25% Off Promotion">
                    </div>

                    <div class="textinfo">
                        <h2><b>Book Your Appointment Now And Get 25% Off</b></h2>
                        <p>Awesome Monsoon Sale - 25% Off on All Professional Make Up only ₱500</p>
                    </div>

                    <a href="appointment.php">BOOK AN APPOINTMENT</a>
                </section>

                <!-- transformBox -->
                <div class="transformBox">
                    <h2>Priced Beauty Solutions</h2>
                    <p>Affordable pricing for premium services.</p>
                </div>

                <!-- section five  -->
                <section class="sectionFive">
                    <div class="BeautySolutions">
                        <h2>Salon Services</h2>
                        <span></span>
                        <ul>
                            <li>ALL IN TRIO <span>₱1399</span></li>
                            <li>COLOR <span>₱499</span></li>
                            <li>REBOND <span>₱499</span></li>
                            <li>BRAZILIAN <span>₱499</span></li>
                            <li>HAIR CUT <span>₱299</span></li>
                        </ul>
                    </div>
                    <div class="BeautySolutions">
                        <h2>Special Services</h2>
                        <span></span>
                        <ul>
                            <li>MICRO BLENDING <span>₱950</span></li>
                            <li>MICRO SHADDING <span>₱400</span></li>
                            <li>EYELASH EXTENSION <span>₱550</span></li>
                            <li>EYELASH REMOVAL <span>₱400</span></li>
                        </ul>
                    </div>
                    <div class="BeautySolutions">
                        <h2>Foot Services</h2>
                        <span></span>
                        <ul>
                            <li>MANICURE <span>₱250</span></li>
                            <li>PEDICURE <span>₱300</span></li>
                            <li>GEL POLISH <span>₱350</span></li>
                            <li>POLYGEL NAILS <span>₱500</span></li>
                            <li>NAIL EXTENSION <span>₱600</span></li>
                            <li>FOOT SPA <span>₱450</span></li>
                        </ul>
                    </div>
                    <div class="BeautySolutions">
                        <h2>Other Services</h2>
                        <span></span>
                        <ul class="scroll-box">
                            <li>ORGANIC <span>₱450</span></li>
                            <li>BOTOX CYST <span>₱800</span></li>
                            <li>FOILAYAGE <span>₱700</span></li>
                            <li>BALAYAGE <span>₱900</span></li>
                            <li>MILKTEA COLOR <span>₱600</span></li>
                            <li>FASHION COLOR <span>₱550</span></li>
                            <li>OMBRE COLOR <span>₱650</span></li>
                            <li>COLD WAVE <span>₱750</span></li>
                            <li>HOT OIL <span>₱300</span></li>
                            <li>HAIR SPA <span>₱500</span></li>
                        </ul>
                    </div>
                </section>

                <!-- section six  -->
                <section class="sectionSix">
                    <h2>Review Us</h2>
                    <div class="icon">
                        <a href="https://www.facebook.com/markniel.veloso" target="_blank" class="fa-brands fa-facebook-f"></a>
                        <a href="https://www.google.com" target="_blank" class="fa-brands fa-google"></a>
                    </div>

                    <div class="img icon">
                        <img src="img/test150x150.jpg" alt="Customer testimonial">
                        <i class="fa-solid fa-quote-right"></i>
                    </div>

                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. A rem soluta cupiditate, asperiores consectetur
                        voluptate, dolor deleniti assumenda laboriosam quae culpa natus iure eum quidem cum ducimus fugit tempora
                        sint. <small>Macoy Manuel Veloso</small></p>
                </section>
			</main>
			<!-- before footer  -->
            <div class="beforefooter">
                <div class="box">
                    <div class="logo">Macoy Strengthening Beauty Salon</div>
                    <div class="bf-text">Macoy Manuel Veloso</div>
                    <p class="para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum ipsam sit magni et
                         consequatur, tenetur ab dolores doloremque totam necessitatibus inventore optio qui? Inventore vel quibusdam
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
                        <li><a href="appointment.php">Services</a></li>
                        <li><a href="aboutus.php">Portfolio</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>

                    <div class="bf-text find-us">Find Us</div>
                    <div class="address">
                        Paliparan 3 Mabuhay City Subd., Blg. 123, Dasmariñas City, Cavite
                    </div>
                </div>

                <div class="box">
                    <div class="bf-text">Say Hi!</div>
                    <ul class="Say Hi">
                        <li><i class="fa-solid fa-envelope contact-icon"></i><a href="mailto:info@example.com">info@example.com</a></li>
                        <li><i class="fa-solid fa-envelope contact-icon"></i><a href="mailto:contact@example.com">contact@example.com</a></li>
                    </ul>

                    <div class="bf-text">Call Us</div>
                    <ul class="Say Hi">
                        <li><i class="fa-solid fa-phone contact-icon"></i> Phone: +63 233 432 5532</li>
                        <li><i class="fa-solid fa-phone contact-icon"></i> Toll Free: +63 233 432 5532</li>
                    </ul>
                </div>
            </div>

                <!-- footer  -->
                <footer>
                    <div class="fbox">Copyright &copy; 2024 Macoy Strengthening Beauty Salon</div>
                    <div class="fbox">Powered by Group 8</div>
                </footer>
		</section>
		<!-- CONTENT -->
		<script src="js/auth.js"></script>
		<script src="js/modal.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>

<?php /* End of fixed home.php */ ?>&#10;
