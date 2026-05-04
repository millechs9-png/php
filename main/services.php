<?php
$page_title = 'Services - Macoy\'s Straightening Beauty Salon';
$allowed_roles = ['guest', 'customer'];
include 'header.php';
?>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/services.css">
<link rel="stylesheet" href="css/MediaQuery.css">

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
				<li class="active">
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
                    <h1>Services</h1>

                    <!-- transparent Img -->
                    <section class="transform-img">
                        <img src="img/background180.svg" alt="">
                    </section>
                </section>


                <!-- section second  -->
                <section class="aboutServices">
                    <div class="ser-litText">Choose From Collection</div>
                    <p class="ser-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, ipsum?</p>

                    <div class="ser-box">
                        <div class="box">
                            <div class="img">
                                <img src="img/nailart_1.jpg" alt="">
                            </div>
                            <div class="boxinfo">
                                <div class="ser-name">Clean Nail Art</div>
                                <p class="ser-discription">This is a short description elaborationg the service you have mentioned
                                    above.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="img">
                                <img src="img/haircut_2.jpg" alt="">
                            </div>
                            <div class="boxinfo">
                                <div class="ser-name">Hair Styling</div>
                                <p class="ser-discription">This is a short description elaborationg the service you have mentioned
                                    above.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="img">
                                <img src="img/massage_3.jpg" alt="">
                            </div>
                            <div class="boxinfo">
                                <div class="ser-name">Full Body Massage</div>
                                <p class="ser-discription">This is a short description elaborationg the service you have mentioned
                                    above.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="img">
                                <img src="img/cosmetics_4.jpg" alt="">
                            </div>
                            <div class="boxinfo">
                                <div class="ser-name">Stocked Cosmetic Store</div>
                                <p class="ser-discription">This is a short description elaborationg the service you have mentioned
                                    above.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="img">
                                <img src="img/spa_5.jpg" alt="">
                            </div>
                            <div class="boxinfo">
                                <div class="ser-name">Fully Equipped Spa</div>
                                <p class="ser-discription">This is a short description elaborationg the service you have mentioned
                                    above.</p>
                            </div>
                        </div>
                        <div class="box">
                            <div class="img">
                                <img src="img/botox_6.jpg" alt="">
                            </div>
                            <div class="boxinfo">
                                <div class="ser-name">Authorized Botox</div>
                                <p class="ser-discription">This is a short description elaborationg the service you have mentioned
                                    above.</p>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- discount section  -->
                <section class="DiscountSection">
                    <div class="img">
                        <img src="img/25off.png" alt="">
                    </div>

                    <div class="textinfo">
                        <h2>Share Your Experience</h2>
                        <p>Your voice matters—rate us today and help shape tomorrow's service!</p>
                    </div>

                    <a href="reviews.php">Rate Now</a>
                </section>

                <!-- ----slider----- -->
                <section class="imgslidertext">
                    <div class="imgslider">
                        <img src="img/bestbrindalOffer1.jpg" alt="" class="slide">
                        <img src="img/bestbrindalOffer2.jpg" alt="" class="slide">
                        <img src="img/bestbrindalOffer3.jpg" alt="" class="slide">

                        <i class="fa-solid fa-chevron-left prev" onclick="goPrev()"></i>
                        <i class="fa-solid fa-chevron-right next" onclick="goNext()"></i>
                    </div>

                    <div class="slideText">
                        <div class="st-heading">The Best Bridal Makeup Offer</div>
                        <p class="lit-text">You Can Highligh a special service here. This can then be bifurcated into smaller steps
                            or parts as done below. Describe it here.</p>

                        <div class="lit-service">
                            <div class="textinfo">
                                <div class="ti-head" >Pre-Wedding Photo shoot</div>
                                <p class="des">This is a shor description elaborating the service you have mentioned above.</p>
                            </div>
                            <div class="textinfo">
                                <div class="ti-head" >The Engagement Day</div>
                                <p class="des">This is a shor description elaborating the service you have mentioned above.</p>
                            </div>
                            <div class="textinfo">
                                <div class="ti-head" >The Grand Wedding Day</div>
                                <p class="des">This is a shor description elaborating the service you have mentioned above.</p>
                            </div>
                        </div>
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
                <div class="fbox">Powered by Macoy Strengthening Beauty Salon</div>
            </footer>
		</section>
		<!-- CONTENT -->

<?php include 'footer.php'; ?>
