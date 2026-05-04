<?php
$page_title = 'Login - Macoy\'s Straightening Beauty Salon';
$allowed_roles = ['guest']; // Login for all, but guest-like
include 'header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<link rel="stylesheet" href="css/login.css">
<link rel="stylesheet" href="css/home.css">    

  <div class="container" id="container">
        <!-- Sign Up -->
        <div class="form-container sign-up">
            <form action="api/register.php" method="POST">
                <h1>Create Account</h1>
                <div class="social-icons">
                <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Sign Up</button>
            </form>
        </div>

        <!-- Sign In -->
        <div class="form-container sign-in">
            <form action="api/login.php" method="POST">
                <h1>Sign In</h1>
                <div class="social-icons">
                <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>or use your email password</span>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <span class="forget-password">
                Forget Your Password? <a href="#">Reset here</a>
                </span>
                <button type="submit">Sign In</button>
            </form>
        </div>

        <!-- Forget Password -->
        <div class="form-container forget-password">
            <form action="api/reset-password.php" method="POST"> <!-- Assume endpoint -->
                <h1>Reset Password</h1>
                <div class="social-icons">
                <a href="#"><i class="fa-brands fa-google-plus-g"></i></a>
                <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
                <span>Enter your email to receive reset link</span>
                <input type="email" name="email" placeholder="Email" required>
                <button type="submit">Send Reset Link</button>
                <span class="back-to-login">
                <a href="#">Back to Sign In</a>
                </span>
            </form>
        </div>

        <!-- Toggle Panels -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                <h1>Welcome Back!</h1>
                <p>Enter your personal details to use all of site features</p>
                <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                <h1>Hello, Friend!</h1>
                <p>Register with your personal details to use all of site features</p>
                <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
  </div>

<?php include 'footer.php'; 

// Page-specific JS
?>
<script src="js/login.js"></script>
