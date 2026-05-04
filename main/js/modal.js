// Login Modal Logic

function showLoginModal() {
  let modal = document.getElementById('loginModal');
  if (!modal) {
    modal = document.createElement('div');
    modal.id = 'loginModal';
    modal.innerHTML = `
      <div class="modal-overlay" onclick="hideLoginModal()">
        <div class="modal-content login-flip" onclick="event.stopPropagation()">
          <div class="form-container sign-in">
            <form id="modalSignIn">
              <h2>Sign In</h2>
              <input type="email" id="modalEmail" placeholder="Email" required>
              <input type="password" id="modalPass" placeholder="Password" required>
              <button type="submit">Sign In</button>
            </form>
          </div>
          <div class="form-container sign-up" style="display:none;">
            <form id="modalSignUp">
              <h2>Create Account</h2>
              <input type="text" id="modalName" placeholder="Name" required>
              <input type="email" id="modalEmailReg" placeholder="Email" required>
              <input type="password" id="modalPassReg" placeholder="Password" required>
              <button type="submit">Sign Up</button>
            </form>
          </div>
          <button id="modalToggleReg" >Register</button>
          <button onclick="hideLoginModal()">Close</button>
        </div>
    `;
    modal.style.cssText = `
      position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:10000;display:flex;align-items:center;justify-content:center;
    `;
    modal.querySelector('.modal-content').style.cssText = `
      background:white;border-radius:20px;padding:30px;max-width:400px;width:90%;max-height:80vh;overflow:auto;
    `;
    document.body.appendChild(modal);
  }
  modal.style.display = 'flex';
  document.body.style.overflow = 'hidden';
}

function hideLoginModal() {
  const modal = document.getElementById('loginModal');
  if (modal) modal.style.display = 'none';
  document.body.style.overflow = '';
}

function initModalListeners() {
  const modalToggleReg = document.getElementById('modalToggleReg');
  if (modalToggleReg) {
    modalToggleReg.onclick = () => {
      const signIn = document.querySelector('.modal-content .sign-in');
      const signUp = document.querySelector('.modal-content .sign-up');
      signIn.style.display = signIn.style.display === 'none' ? 'block' : 'none';
      signUp.style.display = signUp.style.display === 'none' ? 'block' : 'none';
    };
  }

  const signInForm = document.getElementById('modalSignIn');
  if (signInForm) {
    signInForm.onsubmit = async (e) => {
      e.preventDefault();
      try {
        const email = document.getElementById('modalEmail').value.trim();
        const pass = document.getElementById('modalPass').value;
        const user = await AUTH.login(email, pass);
        hideLoginModal();
        if (user.role === 'admin') {
          window.location.href = 'Admin/index.html';
        } else if (user.role === 'staff') {
          window.location.href = 'Staff/staff.html';
        } else {
          location.reload();
        }
      } catch (err) {
        alert(err.message);
      }
    };
  }

  const signUpForm = document.getElementById('modalSignUp');
  if (signUpForm) {
    signUpForm.onsubmit = async (e) => {
      e.preventDefault();
      try {
        const name = document.getElementById('modalName').value.trim();
        const email = document.getElementById('modalEmailReg').value.trim();
        const pass = document.getElementById('modalPassReg').value;
        const user = await AUTH.register(name, email, pass);
        hideLoginModal();
        if (user.role === 'admin') {
          window.location.href = 'Admin/index.html';
        } else if (user.role === 'staff') {
          window.location.href = 'Staff/staff.html';
        } else {
          location.reload();
        }
      } catch (err) {
        alert(err.message);
      }
    };
  }
}

// Navbar triggers
function initAuthNavbar() {
  const appointmentBtn = document.querySelector('.appointment-btn');
  const accountLi = document.getElementById('account-li');
  const profile = document.querySelector('.profile');
  const logoutLink = document.querySelector('.logout');

  if (appointmentBtn) appointmentBtn.onclick = (e) => {
    e.preventDefault();
    if (!AUTH.isLoggedIn()) {
      window.location.href = 'login.html';
      return false;
    } else {
      window.location.href = 'appointment.html';
    }
  };

  if (accountLi) {
    accountLi.onclick = (e) => {
      if (!AUTH.isLoggedIn()) {
        e.preventDefault();
        window.location.href = 'login.html';
        return false;
      }
    };
  }

  if (logoutLink) logoutLink.onclick = (e) => {
    AUTH.logout();
    location.href = 'login.html';
  };

  // Toggle visibility based on auth state
  const isLoggedIn = AUTH.isLoggedIn();
  document.querySelectorAll('.logged-in-only').forEach(el => {
    el.style.display = isLoggedIn ? '' : 'none';
  });
  document.querySelectorAll('.guest-only').forEach(el => {
    el.style.display = isLoggedIn ? 'none' : '';
  });

  // Handle book now buttons
  document.querySelectorAll('.book-now-btn').forEach(btn => {
    btn.onclick = (e) => {
      if (!AUTH.isLoggedIn()) {
        e.preventDefault();
        window.location.href = 'login.html';
        return false;
      }
    };
  });

  // Check page access for guests
  checkGuestAccess();
}

function checkGuestAccess() {
  if (AUTH.isLoggedIn()) return;

  const allowedPages = ['home.html', 'aboutus.html', 'services.html', 'portfolio.html', 'contact.html', 'login.html', 'logout.html'];
  const currentPage = window.location.pathname.split('/').pop() || 'home.html';

  if (!allowedPages.includes(currentPage)) {
    window.location.href = 'login.html';
  }
}

// Initialize on load
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initAuthNavbar);
} else {
  initAuthNavbar();
}
