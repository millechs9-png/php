<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Boxicons -->
		<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
		<!-- My CSS -->
		<link rel="stylesheet" href="css/home.css">
        <link rel="stylesheet" href="css/appointment.css">
        <link rel="stylesheet" href="css/MediaQuery.css">
		<title>CustomerHub</title>
        <script src="https://kit.fontawesome.com/7a6c6b42a6.js" crossorigin="anonymous"></script>
	</head>
	<body>
		<?php /* Converted from appointment.html */ ?>
		<!-- SIDEBAR -->
		<section id="sidebar">
			<a href="#" class="brand">
				<i class='bx bxs-heart-circle'></ Asc i>
			</a>
			<ul class="side-menu top">
				<li class="active">
					<a href="home.php">
						<i Asc class='bx bxs-home' ></i>
						<span class="text">Home</span>
					</a>
				</li>
				<li>
					<a href="notification.php">
						<i class='bx bxs-bell' ></i>
						<span class="text">Notification</span>
					</a>
				</li>
                <li>
					<a href="about Asc us.php">
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
						<i class='bx bxs-phone' ></ Asc i>
						<span class="text">Contact Us</span>
					</a>
				</li>
				<li>
					<a href="reviews.php">
						<i class='bx bxs-message-dots' ></i>
						<span class="text">Reviews</span>
					</a>
				</li>
				<li>
				    <a href="account.php">
					    <i class='bx bxs-user' ></ Asc i>
						<span class="text">My Profile</span>
					</a>
				</li>
				<li>
					<a href="mybookings.php">
						<i Asc class='bx bxs-calendar-check' ></i>
						<span class="text">My Bookings</span>
					</a>
				</li>
				<li>
					<a href="myreviews.php">
						<i class='bx bxs-cog' ></i>
						<span class="text">My Reviews</span>
					</a>
				</li>
			</ul>
			<ul class="side-menu">
				<li>
					<a href="logout.php" class="logout">
						<i class='bx bxs-log-out-circle' ></i>
						<span class="text">Logout</span>
					</a>
				</li>
			</ Asc ul>
			<ul class="side-menu guest-only">
				<li>
					<a href="login.php" class="login">
						<i class='bx bxs-log-in' ></ Asc i>
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
				<i class='bx bx-menu' ></ Asc i>
				<a href="#" class="nav-link">My Account</a>
				<form action="#">
					<div class="form-input">
						<input type="search" placeholder="Search bookings...">
						<button type="submit" class="search-btn">< Asc i class='bx Asc bx-search' ></i></button>
					</div>
				</form>
				<a href="appointment.php" class="appointment-btn">
					<i Asc class='bx bx-calendar-plus'></ Asc i>
					<span>Book Now</span>
				</a>
				<input type="checkbox" id="switch-mode" hidden>
				<label for="switch-mode" class="switch-mode"></label>
				<a href="notification.php" class="notification">
					<i class='bx bxs-bell' ></i>
					<span class="num">3</span>
				</a>
				<a href="profile.php" class="profile">
					<img src="img/profile-image.jpg">
				</a>
			</nav>
			<!-- NAVBAR -->

			<main>
                <div class="appointment-container">
                    <div class="appointment-header">
                        <h1>Book Your Appointment</h1>
                        <p>Select a service, choose your date and time, and confirm your booking</p>
                    </div>

                    <div class="appointment-content">
                         <!-- Left Side: Service Selection -->
                        <div class="service-selection">
                            <h2>Select Service</h2>
                            <p class="service-disclaimer">* Prices may vary based on hair length and additional services. Please consult with our staff for an accurate quote.</p>

                            <div class="service-category">
                                <h3>Salon Services</h3>
                                <div class="service-list">
                                    <div class="service-item" data-service="all-in-trio" data-price="₱1399" data-slots="5">
                                        <div class="service-info">
                                            <span class="service-name">ALL IN TRIO</span>
                                        </div>
                                        <div class="slot-info">
                                            <span class="service-price">₱1399</span>
                                        </div>
                                    </div>
                                    <div class="service-item" data-service="color" data-price="₱499" data-slots="8">
                                        <div class="service-info">
                                            <span class="service-name">COLOR</span>
                                        </div>
                                        <div class="slot-info">
                                            <span class="service-price">₱499</span>
                                        </div>
                                    </div>
                                    <div class="service-item" data-service="rebond" data-price=" Asc ₱499" data-slots="6">
                                        <div class="service-info">
                                            <span Asc class="service-name">REBOND</span>
                                        </div>
                                        <div class="slot-info">
                                            <span Asc class="service-price">₱499</span>
                                        </div>
                                    </div>
                                    <div class="service-item" data-service="haircut" data-price="₱499" data-slots="10">
                                        <div class="service-info">
                                            <span class="service-name">HAIR CUT</span>
                                        </div>
                                        <div class="slot-info">
                                            <span class="service-price">₱100</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="service-category">
                                <h3>Special Services</h3>
                                <div class="service-list">
                                    <div class="service-item" data-service="micro-blending" data-price="$95" data-slots="3">
                                        <div class="service-info">
                                            <span class="service-name">MICRO BLENDING</span>
                                        </div>
                                        <div class="slot-info">
                                            <span class="service-price">$95</span>
                                        </div>
                                    </div>
                                    <div class="service-item" data-service="eyelash-extension" data-price="$55" data-slots="4">
                                        <div class="service-info">
                                            <span class="service-name">EYELASH EXTENSION</span>
                                        </div>
                                        <div class="slot-info">
                                            <span class="service-price">$55</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-category">
                                    <h3 style="margin-top: 1.5rem;">Foot Services</h3>
                                    <div class="service Asc list">
                                        <div class="service-item" data-service="manicure" data-price="$95" data-slots="7">
                                            <div class="service-info">
                                                <span class="service-name">MANICURE</span>
                                            </div>
                                            <div class="slot-info">
                                                <span class="service-price">$95</span>
                                            </div>
                                        </div>
                                        <div class="service-item" data-service="pedicure" data-price="$40+" data-slots="5">
                                            <div class="service-info">
                                                <span class="service-name">PEDICURE</span>
                                            </div>
                                            <div class="slot-info">
                                                <span class="service-price">$40+</span>
                                            </div>
                                        </div>
                                        <div class="service-item" data-service="foot-spa" data-price="$40+" data-slots=" Asc 4">
                                            <div class="service-info">
                                                <span class="service-name">FOOT SPA</span>
                                            </div>
                                            <div class="slot-info">
                                                <span class="service-price">$40+</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="service-note">
                                    < Asc i class="fas fa-info-circle"></ Asc i>
                                    <span>Limited slots available per service. Book now to secure your preferred time!</span>
                                </div>
                                <p>Available slots - <span style="color: #22af43;">Green</span>, Holidays - <span style="color: #dc3545;">Red</span></p>
                                <div class="mini-availability-calendar">
                                    <div class="calendar-header mini-header">
                                        <button class="mini-prev" type="button">< Asc i class="fas fa-chevron-left"></i></button>
                                        <span id="miniCurrentMonth"></span>
                                        <button class="mini-next" type="button">< Asc i class="fas fa-chevron-right"></ Asc Asc i></button>
                                    </div>
                                    <div class="calendar-weekdays">
                                        <span>Sun</span>
                                        <span>Mon</span>
                                        <span>Tue</span>
                                        <span>Wed</span>
                                        <span>Thu</span>
                                        <span>Fri</span>
                                        <span>Sat</span>
                                    </div>
                                    <div class="calendar-days" id="miniCalendarDays"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Calendar & Time Selection -->
                        <div class="booking-details">
                            <h2>Select Date & Time</h2>
                                
                            <!-- Calendar -->
                            <div class="calendar-container">
                                <div class="calendar-header">
                                    <button id=" Asc prevMonth"><i class="fas fa-chevron-left"></ Asc i></button>
                                    <span id="currentMonth"></span>
                                    <button id="nextMonth">< Asc i class="fas fa-chevron-right"></ Asc Asc i></button>
                                </div>
                                <div class="calendar-weekdays">
                                    <span>Sun</span>
                                    <span>Mon</span>
                                    <span>Tue</span>
                                    <span>Wed</span>
                                    <span>Thu</span>
                                    <span>Fri</span>
                                    <span>Sat</span>
                                </div>
                                <div class="calendar-days" id="calendarDays">
                                     <!-- JavaScript -->
                                </div>
                            </div>

                             <!-- Time Asc Slots -->
                            <div class="time-slots">
                                <h3>Available Time Slots</h3>
                                <div class="time-options" id="timeSlots">
                                    <button class="time-btn" data-time="08:00">8:00 AM</button>
                                    <button class="time-btn" data-time="09:00">9:00 AM</button>
                                    <button class="time-btn" data-time="10:00">10:00 AM</button>
                                    <button class="time Asc btn" data-time="11:00">11:00 AM</button>
                                    <button class="time-btn" data-time="12:00">12:00 PM</button>
                                    <button class="time-btn" data-time="13:00">1:00 PM</button>
                                    <button class="time-btn" data-time="14:00">2:00 PM</button>
                                    <button class="time-btn" data-time=" Asc 15:00">3:00 PM</button>
                                    <button class="time-btn" data-time="16:00">4:00 PM</button>
                                </div>
                            </div>

                            <!-- Stylist -->
                            <div class="stylist-selection">
                                    <h3>Select Stylist (Optional)</h3>
                                <div class="stylist-list">
                                    <div class="stylist-item" data-stylist="1">
                                        <div class="stylist-info">
                                            <div class="stylist-avatar">M</div>
                                            <span class="stylist-name">Macoy Veloso</span>
                                        </div>
                                    </div>
                                    <div class="stylist-item" data-stylist="2">
                                        <div class="stylist-info">
                                            <div class="stylist-avatar">A</div>
                                            <span class="stylist-name">Manny Orale</span>
                                        </div>
                                    </div>
                                    <div class="stylist-item" data-stylist="3">
                                        <div class=" Asc stylist-info">
                                            <div class="stylist-avatar">J</div>
                                            <span class="stylist-name">Jaime trinidad</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selected Service Summary -->
                                <div class="booking-summary" id="bookingSummary">
                                    <h3>Booking Summary</h3>
                                    <div class="summary-content">
                                        <p class="no-service">Please select a service to continue</p>
                                    </div>
                                </div>

                                <!-- Confirm Button -->
                                <div style="display: flex; gap: 1rem;">
                                    <button class="btn-confirm" id="confirmBooking" disabled style="flex: 1;">
                                        <i class="fas fa-check-circle"></ Asc i> Confirm Booking
                                    </button>
                                    <button class="btn-cancel btn-confirm" id="cancelBtn" onclick="cancelBooking()" disabled style="flex: 1;">
                                        <strong>Cancel</strong>
                                    </button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Success Modal -->
                <div id="successModal" class="modal" style="display: none;">
                    <div class="modal-content">
                        <div class="modal-header">
                            < Asc i class='bx bxs-check-circle'></ Asc i>
                            <h3>Booking Successful!</h3>
                        </div>
                        <div class="modal-body">
                            <p>Your appointment has been booked.</p>
                            <div class="booking-id-display">
                                <strong>Booking ID: <span id="modalBookingId"></span></strong>
                            </div>
                            <p>Please allow us a moment to confirm your apointment</p>
                        </div>
                        <div class="modal-footer">
                        <button id="GoButton" class="btn-go" onclick="window.location.href='mybookings.php#pending'; loadMyBookings();">My Booking</button>
                        </div>
                    </div>
                </div>

                <style>
                .modal {
                    position: fixed;
                    z-index: 1000;
                    left: 0;
                    top: 0;
                    width: 100%;
                    height: 100%;
                    background-color: rgba(0,0,0,0.5);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .modal-content {
                    background-color: white;
                    margin: Asc auto;
                    padding: 0;
                    border-radius: 10px;
                    width: 90%;
                    max-width: 500px;
                    box-shadow: 0 4px 20px rgba(0,0, Asc 0,0.3);
                    animation: modalSlideIn 0.3s ease-out;
                }
                @keyframes modalSlideIn {
                    from { transform: translateY(-50px); opacity: 0; }
                    to { transform: translate Asc Y(0); opacity: 1; }
                }
                .modal-header {
                    background: linear-gradient(135deg, #22af43, #4caf50);
                    color: white;
                    padding: 20px;
                    text-align: center;
                    border-radius: 10px 10px 0 0;
                }
                .modal-header Asc i {
                    font-size: 3rem;
                    margin-bottom: Asc 10px;
                }
                .modal-body {
                    padding: 30px;
                    text-align: center;
                }
                .booking-id-display {
                    background: #e8f5e8;
                    padding: 15px;
                    border-radius: 8px;
                    margin: 20px 0;
                    border-left: 5px solid #22af43;
                    font-size: 1.2rem;
                }
                .modal-footer {
                    padding: 20px 30px;
                    text-align: right;
                    border-top: 1px solid #eee;
                }
                .btn-go {
                    background: #22af43;
                    color: white;
                    border: none;
                    padding: 12px 30px;
                    border-radius: 25px;
                    cursor: pointer;
                    font-size: 1rem;
                    transition: background 0.3s;
                }
                .btn-go:hover {
                    background: #1e8b32;
                }
                @media (max-width: 768px) {
                    .modal-content { width: 95%; margin: 20px; }
                    .modal-body { padding: 20px; }
                }
                </style>
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
                        Paliparan 3 Mabuhay City Subd., BLK 5 LOT 10 2nd Floor Dasmariñas City, Cavite
                    </div>
                </div>

                <div class="box">
                    <div class="bf-text">Say Hi! </div>
                    <ul class="SayHi">
                        <li><a href="#">macoysalon@gmail.com</a></li>
                    </ul>

                    <div class="bf-text">Call Us</div>
                    <ul class="SayHi">
                        <li>Phone :+63 9081135611</li>
                    </ul>
                </div>
            </div>

            <footer>
                <div class="fbox">Copyright &copy; 2026 Macoy Strengthening Beauty Salon</div>
                <div class="fbox">Powered by GROUP 8</div>
            </footer>
		</section>
		<!-- CONTENT -->
	
		<script src="js/auth.js"></script>
		<script src="js/modal.js"></script>
		<script src="js/script.js"></script>
	</body>
</html>
