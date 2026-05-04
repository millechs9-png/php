<?php
$page_title = 'My Bookings - Macoy\'s Straightening Beauty Salon';
$allowed_roles = ['customer'];
include 'header.php';
?>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/mybookings.css">
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
			<li class="logged-in-only">
				<a href="account.php">
					<i class='bx bxs-user' ></i>
					<span class="text">Profile</span>
				</a>
			</li>
			<li class="active">
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
			<div class="content-section" id="schedule">
                <div class="section-header">
                    <h2>My Bookings</h2>
                </div>

                <!-- MyBookings Filters -->
                <div class="mybooking-filters">
                    <button class="filter-btn active" data-filter="confirmed">Confirmed</button>
                    <button class="filter-btn" data-filter="pending">Pending</button>
                    <button class="filter-btn" data-filter="history">History</button>
                </div>

                <!-- MyBookings Container -->
                <div class="mybookings-container" id="dynamicBookingsContainer">
                
                    <div class="booking-section" data-type="confirmed">
                        <h3 class="section-title">Confirmed Bookings</h3>
                        <?php
                        $bookings = json_decode(file_get_contents('data/bookings.json'), true) ?? [];
                        $user_id = $_SESSION['id'] ?? 0;
                        $confirmed = array_filter($bookings, fn($b) => $b['user_id'] == $user_id && $b['status'] === 'confirmed');
                        foreach ($confirmed as $booking):
                        ?>
                        <div class="booking-item confirmed" data-type="confirmed">
                            <div class="booking-icon confirmed">
                                <i class='bx bx-calendar-check'></i>
                            </div>
                            <div class="booking-content">
                                <h4><?php echo htmlspecialchars($booking['service']); ?><br><?php echo htmlspecialchars($booking['id']); ?></h4>
                                <p><?php echo date('M d, Y', strtotime($booking['date'])); ?> at <?php echo htmlspecialchars($booking['time']); ?> with <?php echo htmlspecialchars($booking['stylist']); ?></p>
                                <div class="booking-status confirmed">Confirmed</div>
                                <span class="booking-time"><?php echo htmlspecialchars($booking['time']); ?></span>
                            </div>
                            <div class="booking-actions">
                                <a href="#" class="btn-view">View Details</a>
                                <button class="btn-cancel" onclick="cancelBooking('<?php echo $booking['id']; ?>')">Cancel</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="booking-section" data-type="pending">
                        <h3 class="section-title">Pending Bookings</h3>
                        <?php
                        $pending = array_filter($bookings, fn($b) => $b['user_id'] == $user_id && $b['status'] === 'pending');
                        foreach ($pending as $booking):
                        ?>
                        <div class="booking-item pending" data-type="pending">
                            <div class="booking-icon pending">
                                <i class='bx bx-calendar-clock'></i>
                            </div>
                            <div class="booking-content">
                                <h4><?php echo htmlspecialchars($booking['service']); ?><br><?php echo htmlspecialchars($booking['id']); ?></h4>
                                <p><?php echo date('M d, Y', strtotime($booking['date'])); ?> at <?php echo htmlspecialchars($booking['time']); ?></p>
                                <div class="booking-status pending">Pending Approval</div>
                            </div>
                            <div class="booking-actions">
                                <button class="btn-cancel" onclick="cancelPendingBooking('<?php echo $booking['id']; ?>')">Cancel Request</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="booking-section" data-type="history">
                        <h3 class="section-title">Booking History</h3>
                        <?php
                        $history = array_filter($bookings, fn($b) => $b['user_id'] == $user_id && $b['status'] === 'completed');
                        foreach ($history as $booking):
                        ?>
                        <div class="booking-item completed" data-type="history">
                            <div class="booking-icon completed">
                                <i class='bx bx-check-circle'></i>
                            </div>
                            <div class="booking-content">
                                <h4><?php echo htmlspecialchars($booking['service']); ?><br><?php echo htmlspecialchars($booking['id']); ?></h4>
                                <p><?php echo date('M d, Y', strtotime($booking['date'])); ?> at <?php echo htmlspecialchars($booking['time']); ?></p>
                                <div class="booking-status completed">Completed</div>
                            </div>
                            <div class="booking-actions">
                                <a href="#" class="btn-view">View Receipt</a>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Empty State -->
                <div class="empty-state" id="emptyBookingsState" <?php if (count(array_merge($confirmed, $pending, $history)) > 0): ?>style="display: none;"<?php endif; ?>>
                    <i class='bx bx-calendar-x'></i>
                    <h3>No Bookings Found</h3>
                    <p>You don't have any bookings matching this filter. <a href="appointment.php">Book now!</a></p>
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

<script src="js/bookings.js"></script>
<script>
    // MyBookings Filter Functionality with PHP data
    const filterButtons = document.querySelectorAll('.filter-btn');
    const bookingSections = document.querySelectorAll('.booking-section');
    const emptyState = document.getElementById('emptyBookingsState');

    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to the clicked button
            button.classList.add('active');

            const filterType = button.getAttribute('data-filter');
            let hasVisibleBookings = false;

            bookingSections.forEach(section => {
                if (section.getAttribute('data-type') === filterType) {
                    section.classList.remove('hidden');
                    if (section.querySelectorAll('.booking-item').length > 0) {
                        hasVisibleBookings = true;
                    }
                } else {
                    section.classList.add('hidden');
                }
            });

            // Show empty state if no bookings are visible
            if (!hasVisibleBookings) {
                emptyState.style.display = 'block';
            } else {
                emptyState.style.display = 'none';
            }
        });
    });

    function cancelBooking(id) {
        if (confirm('Cancel this booking?')) {
            fetch('api/bookings.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'cancel', id})
            }).then(() => location.reload());
        }
    }

    function cancelPendingBooking(id) {
        if (confirm('Cancel this pending booking request?')) {
            fetch('api/bookings.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'cancel_pending', id})
            }).then(() => location.reload());
        }
    }
</script>
