// --- UI toggling (short JS) ---
const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');
const resetBtn = document.getElementById('resetHere');
const backBtn = document.getElementById('backToLogin');

// Toggle Sign Up
if (registerBtn) {
    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });
}

// Toggle Sign In
if (loginBtn) {
    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
}

// Forget Password toggle
if (resetBtn) {
    resetBtn.addEventListener('click', () => {
        container.classList.add('forget-active');
    });
}

if (backBtn) {
    backBtn.addEventListener('click', () => {
        container.classList.remove('forget-active');
    });
}

// --- Form logic, AUTH, validation (long JS) ---
document.addEventListener('DOMContentLoaded', function() {
    const signInForm = document.querySelector('.form-container.sign-in form');
    const signUpForm = document.querySelector('.form-container.sign-up form');
    const forgetForm = document.querySelector('.form-container.forget-password form');

    // Sign In handler
    if (signInForm) {
        signInForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const emailInput = signInForm.querySelector('input[placeholder="Email"]');
            const passInput = signInForm.querySelector('input[type="password"]');
            try {
                const email = emailInput.value.trim();
                const password = passInput.value;
                if (!password) throw new Error('Password required');
                const user = await AUTH.login(email, password);
                alert(`Welcome back, ${user.name}!`);
                // Role redirect
                if (user.role === 'admin') {
                    window.location.href = 'Admin/index.html';
                } else if (user.role === 'staff') {
                    window.location.href = 'Staff/staff.html';
                } else {
                    window.location.href = 'home.html';
                }
            } catch (err) {
                alert(err.message);
            }
        });
    }

    // Sign Up handler
    if (signUpForm) {
        const firstNameInput = signUpForm.querySelector('input[placeholder="First Name"]');
        const lastNameInput = signUpForm.querySelector('input[placeholder="Last Name"]');

        // Real-time capitalization
        function capitalizeInput(input) {
            input.addEventListener('input', function(e) {
                let value = e.target.value;
                value = value.replace(/\b[a-z]/g, char => char.toUpperCase());
                e.target.value = value;
            });
            input.addEventListener('keyup', function(e) {
                if (e.key === ' ') {
                    let value = e.target.value;
                    value = value.replace(/\b[a-z]/g, char => char.toUpperCase());
                    e.target.value = value;
                }
            });
        }

        capitalizeInput(firstNameInput);
        capitalizeInput(lastNameInput);

        signUpForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            const firstName = firstNameInput.value.trim();
            const lastName = lastNameInput.value.trim();
            const name = firstName.charAt(0).toUpperCase() + firstName.slice(1).toLowerCase() + 
                       ' ' + lastName.charAt(0).toUpperCase() + lastName.slice(1).toLowerCase();

            const emailInput = signUpForm.querySelector('input[placeholder="Email"]');
            const passInput = signUpForm.querySelector('input[type="password"]');
            try {
                const email = emailInput.value.trim();
                const password = passInput.value;
                if (!name || !email || !password) throw new Error('All fields required');
                const user = await AUTH.register(name, email, password);
                alert(`Welcome, ${user.name}!`);
                window.location.href = 'home.html';
            } catch (err) {
                alert(err.message);
            }
        });
    }

    // Forget Password handler
    if (forgetForm) {
        forgetForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const emailInput = forgetForm.querySelector('input[placeholder="Email"]');
            const email = emailInput.value.trim();
            if (!email) {
                alert('Email required');
                return;
            }
            alert('Reset link sent to ' + email + '!');
            container.classList.remove('forget-active');
        });
    }
});
