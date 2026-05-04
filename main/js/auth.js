// Salon Auth - PHP API Client
// All auth operations now call the PHP REST API.

const API_BASE = (() => {
  const depth = window.location.pathname.split('/').filter(Boolean).length - 1;
  return '../'.repeat(depth) + 'api/';
})();

const AUTH = {
  async init() {
    // Hydrate current user from server if token exists
    const token = localStorage.getItem('token');
    if (token) {
      try {
        const res = await fetch(API_BASE + 'me.php', {
          headers: { 'Authorization': 'Bearer ' + token }
        });
        if (res.ok) {
          const user = await res.json();
          localStorage.setItem('currentUser', JSON.stringify(user));
        } else {
          this.logout();
        }
      } catch {
        this.logout();
      }
    }
  },

  async login(email, password) {
    const res = await fetch(API_BASE + 'login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ email, password })
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.error || 'Login failed');
    localStorage.setItem('token', data.token);
    localStorage.setItem('currentUser', JSON.stringify(data.user));
    return data.user;
  },

  async register(name, email, password) {
    const res = await fetch(API_BASE + 'register.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ name, email, password })
    });
    const data = await res.json();
    if (!res.ok) throw new Error(data.error || 'Registration failed');
    localStorage.setItem('token', data.token);
    localStorage.setItem('currentUser', JSON.stringify(data.user));
    return data.user;
  },

  logout() {
    localStorage.removeItem('token');
    localStorage.removeItem('currentUser');
  },

  getCurrentUser() {
    try {
      return JSON.parse(localStorage.getItem('currentUser') || 'null');
    } catch {
      return null;
    }
  },

  getToken() {
    return localStorage.getItem('token');
  },

  isLoggedIn() {
    return !!this.getToken();
  },

  getRole() {
    const user = this.getCurrentUser();
    return user ? user.role : null;
  },

  requireRole(requiredRole) {
    const role = this.getRole();
    if (!role || role !== requiredRole) {
      alert('Access denied. Wrong role.');
      window.location.href = 'login.html';
      return false;
    }
    return true;
  },

  protectPage() {
    if (!this.isLoggedIn()) {
      window.location.href = 'login.html';
      return false;
    }
    return true;
  },

  // Booking helpers now call API
  async getUserBookings() {
    const token = this.getToken();
    if (!token) return [];
    const res = await fetch(API_BASE + 'bookings.php', {
      headers: { 'Authorization': 'Bearer ' + token }
    });
    if (!res.ok) return [];
    return await res.json();
  },

  async addBooking(booking) {
    const token = this.getToken();
    if (!token) return;
    const res = await fetch(API_BASE + 'bookings.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Authorization': 'Bearer ' + token
      },
      body: JSON.stringify(booking)
    });
    return await res.json();
  }
};

// Auto init
AUTH.init();
