<?php
$page_title = 'My Profile - Macoy\'s Straightening Beauty Salon';
$allowed_roles = ['customer'];
include 'header.php';
?>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/account.css">
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
					<li class="active">
					    <a href="account.php">
						    <i class='bx bxs-user' ></i>
							<span class="text">My Profile</span>
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
				<nav>
					<i class='bx bx-menu'></i>
					<a href="#" class="nav-link">Profile</a>
					<form action="#">
						<div class="form-input">
							<input type="search" placeholder="Search...">
							<button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
						</div>
					</form>
					<a href="appointment.php" class="appointment-btn">
						<i class='bx bx-calendar-plus'></i>
						<span>Book Now</span>
					</a>
					<input type="checkbox" id="switch-mode" hidden>
					<label for="switch-mode" class="switch-mode"></label>
					<a href="notification.php" class="notification logged-in-only">
						<i class='bx bxs-bell'></i>
						<span class="num"><?php echo rand(1,10); ?></span>
					</a>
					<a href="account.php" class="profile logged-in-only">
						<img src="img/profile-image.jpg">
					</a>
				</nav>

				<main>
					<div class="account-content">
						<div class="content-section active" id="profile">
							<div class="section-header">
								<h2>Profile</h2>
							</div>
							
							<div class="profile-columns">
								<div class="profile-column">
									<div class="profile-card">
										<div class="profile-picture-section">
											<div class="avatar">
												<img id="profileImage" src="img/profile-image.jpg" alt="Profile">
											</div>
											<label for="pictureInput" class="change-photo-btn">
												<i class="fas fa-camera"></i> Change Photo
											</label>
											<input type="file" id="pictureInput" accept="image/*" style="display: none;">
										</div>
										
										<div class="profile-details">
											<h3 id="displayName"><?php echo htmlspecialchars($_SESSION['name'] ?? 'User Name'); ?></h3>
											<div class="email-verified">
												<i class="fas fa-check-circle"></i>
												<span id="displayEmail"><?php echo htmlspecialchars($_SESSION['email'] ?? 'user@example.com'); ?></span>
											</div>
											<p class="client-id">Client ID: <span id="clientId"><?php echo htmlspecialchars($_SESSION['id'] ?? '#MSB-2026-001'); ?></span></p>
										</div>
										
										<!-- Editable -->
										<div class="account-details" id="accountDetailsSection">
											<!-- Display Mode -->
											<div class="detail-display" id="detailDisplay">
												<div class="detail-item">
													<label>Full Name</label>
													<p id="displayFullName"><?php echo htmlspecialchars($_SESSION['name'] ?? 'User Name'); ?></p>
												</div>
												<div class="detail-item">
													<label>Phone Number</label>
													<p id="displayPhone"><?php echo htmlspecialchars($_SESSION['phone'] ?? '+1 233 432 5532'); ?></p>
												</div>
												<div class="detail-item">
												<label>Update Password</label>
												<form id="change-password-form" action="api/update-password.php" method="POST" class="update-form">
														<div class="form-group"><i class="fa fa-lock"></i><input
															type="password" name="old_password"
															class="form-control" required=""
															placeholder="Current password">
														</div>
														<div class="form-group"><i class="fa fa-lock"></i><input
															type="password" name="new_password"
															class="form-control" required=""
															placeholder="New password">
														</div>
														<div class="form-group"><i class="fa fa-lock"></i><input
															type="password" name="confirm_password"
															class="form-control" required=""
															placeholder="Confirm password">
														</div>
														<div class="form-error" style="color: red; padding: 10px 0;"></div>
													<button type="submit">Update Password</button>
												</form>
											</div>
											</div>
											<!-- Edit Mode (Input Fields) -->
											<div class="detail-edit" id="detailEdit" style="display: none;">
												<div class="detail-item">
													<label>Full Name</label>
													<input type="text" id="inputFullName" value="<?php echo htmlspecialchars($_SESSION['name'] ?? 'User Name'); ?>" class="edit-input">
												</div>
												<div class="detail-item">
													<label>Phone Number</label>
													<input type="tel" id="inputPhone" value="<?php echo htmlspecialchars($_SESSION['phone'] ?? '+1 233 432 5532'); ?>" class="edit-input">
												</div>
												<div class="detail-item">
													<label>Update Password</label>
													<form id="change-password-form" action="api/update-password.php" method="POST" class="update-form">
														<div class="form-group"><i class="fa fa-lock"></i><input
															type="password" name="old_password"
															class="form-control" required=""
															placeholder="Current password">
														</div>
														<div class="form-group"><i class="fa fa-lock"></i><input
															type="password" name="new_password"
															class="form-control" required=""
															placeholder="New password">
														</div>
														<div class="form-group"><i class="fa fa-lock"></i><input
															type="password" name="confirm_password"
															class="form-control" required=""
															placeholder="Confirm password">
														</div>
														<div class="form-error" style="color: red; padding: 10px 0;"></div>
													</form>
												</div>
												<div class="profile-buttons">
													<button class="btn-save" onclick="saveProfile()">Save Changes</button>
													<button class="btn-cancel" id="cancelProfileBtn">Cancel</button>
												</div>
											</div>
											
											<!-- Edit Profile Button (shown in display mode) -->
											<button class="btn-edit" id="editProfileBtn">Edit Profile</button>
										</div>
									</div>
								</div>

								<!-- Right Column: Preferences -->
								<div class="preferences-column">
									<div class="preferences-card">
										<h3>Preferences</h3>
										<div class="preferences-display" id="preferencesDisplay">
											<div class="preference-item">
												<label>Email Notifications</label>
												<span class="preference-status">Enabled</span>
											</div>
											<div class="preference-item">
												<label>Schedule Reminder</label>
												<span class="preference-status">Enabled</span>
											</div>
											<div class="preference-item">
												<label>SMS Alert</label>
												<span class="preference-status">Enabled</span>
											</div>
											<div class="preference-item">
												<label>Promotional Notifications</label>
												<span class="preference-status">Enabled</span>
											</div>
										</div>
										<div class="preferences-edit" id="preferencesEdit" style="display: none;">
											<div class="preference-item">
												<label>Email Notifications</label>
												<input type="checkbox" id="emailNotif" checked>
											</div>
											<div class="preference-item">
												<label>Schedule Reminder</label>
												<input type="checkbox" id="scheduleReminder" checked>
											</div>
											<div class="preference-item">
												<label>SMS Alert</label>
												<input type="checkbox" id="smsAlert" checked>
											</div>
											<div class="preference-item">
												<label>Promotional Notifications</label>
												<input type="checkbox" id="promotionalNotif" checked>
											</div>
											<div class="preferences-buttons">
												<button class="btn-save" id="savePreferencesBtn">Save</button>
												<button class="btn-cancel" id="cancelPreferencesBtn">Cancel</button>
											</div>
										</div>
										<div class="preferences-display-buttons">
											<button class="btn-edit" id="editPreferencesBtn">Edit</button>
										</div>
									</div>

									<!-- Legal & Policy Accordion -->
									<div class="legal-policy-card">
										<h3>Legal & Policy</h3>
										<div class="accordion">
											<!-- Privacy Policy -->
											<div class="accordion-item">
												<button class="accordion-header">
													<i class="fas fa-shield-alt"></i> Privacy Policy
												</button>
												<div class="accordion-body">
													<p>At Macoy's Strengthening Beauty Salon, we are committed to protecting your privacy. We collect only essential information for booking and service delivery, never sharing your data with third parties without consent. Your information is securely stored and protected by industry-standard encryption.</p>
												</div>
											</div>

											<!-- Terms of Service -->
											<div class="accordion-item">
												<button class="accordion-header">
													<i class="fas fa-file-contract"></i> Terms of Service
												</button>
												<div class="accordion-body">
													<p>By using our booking system, you agree to our terms, including appointment policies, cancellation rules (24-hour notice required), and liability limitations. We reserve the right to refuse service and apply no-show policies to protect scheduling availability and ensure fairness for all customers.
													<a href="terms.php" target="_blank">Read full Terms of Service</a>.
												</p>
												</div>
											</div>

											<!-- Cookie Policy -->
											<div class="accordion-item">
												<button class="accordion-header">
													<i class="fas fa-cookie-bite"></i> Cookie Policy
												</button>
												<div class="accordion-body">
													<p>We use essential cookies for site functionality and analytics cookies to improve your experience. You can manage preferences in your browser settings. We do not use cookies for advertising or tracking across sites.</p>
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
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
					</div>

					<div class="box">
						<div class="bf-text">Quick Links</div>
						<ul>
							<li><a href="home.php">Home</a></li>
							<li><a href="aboutus.php">About Us</a></li>
							<li><a href="services.php">Services</a></li>
							<li><a href="portfolio.php">Portfolio</a></li>
							<li><a href="contact.php">Contact Us</a></li>
							<li><a href="reviews.php">Reviews</a></li>
						</ul>

						<div class="bf-text" style="margin-top: 1rem;">Find Us</div>
	                    <div class="address">
	                        Paliparan 3 Mabuhay City Subd., Blg. 123, Dasmariñas City, Cavite
	                    </div>
					</div>

					<div class="box">
						<div class="bf-text">Say Hi! </div>
						<ul class="SayHi">
							<li><i class="fa-solid fa-envelope contact-icon"></i><a href="mailto:macoysalon@gmail.com">macoysalon@gmail.com</a></li>
							<li><i class="fa-solid fa-phone contact-icon"></i><a href="tel:+639081135611">Phone :+63 9081135611</a></li>
						</ul>
						
						<div class="bf-text" style="margin-top: 1.5rem;">Follow Us</div>
						<div class="icons">
							<a href="https://www.facebook.com/markniel.veloso" target="_blank" class="fa-brands fa-facebook-f"></a>
							<a href="https://www.google.com" target="_blank" class="fa-brands fa-google"></a>
						</div>
					</div>
				</div>
				<!-- footer  -->
				<footer>
					<div class="fbox">Copyright &copy; 2026 Macoy Strengthening Beauty Salon</div>
					<div class="fbox">Powered by GROUP 8</div>
				</footer>
			</section>

<?php include 'footer.php'; ?>
