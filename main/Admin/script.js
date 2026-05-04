const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
	const li = item.parentElement;

	item.addEventListener('click', function () {
		allSideMenu.forEach(i=> {
			i.parentElement.classList.remove('active');
		})
		li.classList.add('active');
	})
});

// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
	sidebar.classList.toggle('hide');
})

const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
	if(window.innerWidth < 576) {
		e.preventDefault();
		searchForm.classList.toggle('show');
		if(searchForm.classList.contains('show')) {
			searchButtonIcon.classList.replace('bx-search', 'bx-x');
		} else {
			searchButtonIcon.classList.replace('bx-x', 'bx-search');
		}
	}
})

if(window.innerWidth < 768) {
	sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
	searchButtonIcon.classList.replace('bx-x', 'bx-search');
	searchForm.classList.remove('show');
}

window.addEventListener('resize', function () {
	if(this.innerWidth > 576) {
		searchButtonIcon.classList.replace('bx-x', 'bx-search');
		searchForm.classList.remove('show');
	}
})

const switchMode = document.getElementById('switch-mode');

// Restore dark mode from localStorage on page load
if (localStorage.getItem('darkMode') === 'true') {
	document.body.classList.add('dark');
	if (switchMode) switchMode.checked = true;
}

switchMode.addEventListener('change', function () {
	if(this.checked) {
		document.body.classList.add('dark');
		localStorage.setItem('darkMode', 'true');
	} else {
		document.body.classList.remove('dark');
		localStorage.setItem('darkMode', 'false');
	}
})

// Booking Management via PHP API
const API_BASE = '../api/';

function token() { return localStorage.getItem('token'); }

async function apiFetch(url, opts = {}) {
  const res = await fetch(API_BASE + url, {
    ...opts,
    headers: {
      'Content-Type': 'application/json',
      'Authorization': 'Bearer ' + token(),
      ...(opts.headers || {})
    }
  });
  if (!res.ok) {
    const err = await res.json().catch(() => ({}));
    throw new Error(err.error || 'API error');
  }
  return res.json();
}

let bookings = [];

async function loadBookings() {
  try {
    bookings = await apiFetch('bookings.php');
    renderBookings();
  } catch (err) {
    console.error('Failed to load bookings:', err);
  }
}

function getStatusClass(status) {
  switch(status) {
    case 'approved': return 'status approved';
    case 'rejected': return 'status rejected';
    case 'cancelled': return 'status cancelled';
    case 'pending': return 'status pending';
    default: return 'status pending';
  }
}

function renderBookings() {
  const tbody = document.querySelector('#team-bookings tbody');
  if (!tbody) return;

  tbody.innerHTML = bookings.map(booking => `
    <tr>
      <td>
        <img src="${booking.avatar || 'people.png'}">
        <p>${booking.customer}</p>
      </td>
      <td>${Array.isArray(booking.services) ? booking.services.map(s=>s.name).join(' + ') : booking.service}</td>
      <td>${booking.date} ${booking.time}</td>
      <td><span class="${getStatusClass(booking.status)}">${booking.status.toUpperCase()}</span></td>
      <td>
        ${booking.status === 'pending' ? `
          <button class="btn-approve" onclick="handleAction('${booking.bookingId}', 'approved')">
            <i class='bx bx-check'></i> Approve
          </button>
          <button class="btn-reject" onclick="handleAction('${booking.bookingId}', 'rejected')">
            <i class='bx bx-x'></i> Reject
          </button>
        ` : ''}
        ${booking.status === 'cancelled' ? '<span class="cancel-notice">Customer Cancelled</span>' : ''}
      </td>
    </tr>
  `).join('');
}

async function handleAction(bookingId, action) {
  try {
    await apiFetch('bookings.php', { method: 'PUT', body: JSON.stringify({ bookingId, status: action }) });
    await loadBookings();
    const booking = bookings.find(b => b.bookingId === bookingId);
    if (booking) {
      alert(`${action.toUpperCase()} booking for ${booking.customer}`);
    }
  } catch (err) {
    alert(err.message);
  }
}

// ============================
// Dashboard Data (Admin Home)
// ============================
async function loadDashboard() {
  try {
    const data = await apiFetch('dashboard.php');

    // Update box-info cards
    const boxes = document.querySelectorAll('.box-info li');
    if (boxes.length >= 3) {
      boxes[0].querySelector('h3').textContent = data.totalCustomers ?? 0;
      boxes[1].querySelector('h3').textContent = data.totalVisitors ?? 0;
      boxes[2].querySelector('h3').textContent = '₱' + (data.totalRevenue ?? 0).toLocaleString();
    }

    // Update Recent Customers table
    const tbody = document.querySelector('.table-data .order tbody');
    if (tbody && data.recentCustomers) {
      tbody.innerHTML = data.recentCustomers.map(c => `
        <tr>
          <td>
            <img src="people.png" alt="">
            <p>${c.name}</p>
          </td>
          <td>${c.createdAt ? new Date(c.createdAt).toLocaleDateString() : 'N/A'}</td>
          <td><span class="status completed">New</span></td>
        </tr>
      `).join('');
    }

    // Update notification badge with pending bookings
    const notifBadge = document.querySelector('.notification .num');
    if (notifBadge) {
      notifBadge.textContent = data.pendingBookings ?? 0;
    }

    // Update todos with pending bookings
    const todoList = document.querySelector('.todo-list');
    if (todoList && data.todayBookings) {
      todoList.innerHTML = data.todayBookings.map(b => `
        <li class="${b.status === 'confirmed' ? 'completed' : 'not-completed'}">
          <p>${b.customer} — ${b.service} (${b.time})</p>
          <i class='bx bx-dots-vertical-rounded'></i>
        </li>
      `).join('');
      if (data.todayBookings.length === 0) {
        todoList.innerHTML = '<li class="not-completed"><p>No appointments today</p></li>';
      }
    }
  } catch (err) {
    console.error('Dashboard load failed:', err);
  }
}

// ============================
// Analytics Data
// ============================
async function loadAnalytics() {
  try {
    const data = await apiFetch('analytics.php');

    // Update analytics box-info cards
    const boxes = document.querySelectorAll('.box-info li');
    if (boxes.length >= 3) {
      const growth = data.growthRate ?? 0;
      boxes[0].querySelector('h3').textContent = (growth >= 0 ? '+' : '') + growth + '%';
      boxes[1].querySelector('h3').textContent = (data.newCustomersThisMonth ?? 0).toLocaleString();
      // Avg rating is static for now, or could compute from reviews later
      boxes[2].querySelector('h3').textContent = '4.8';
    }

    // Update Monthly Revenue table
    const tbody = document.querySelector('.table-data .order tbody');
    if (tbody && data.monthlyRevenue) {
      tbody.innerHTML = data.monthlyRevenue.map(m => `
        <tr>
          <td>
            <i class='bx bx-calendar'></i>
            <p>${m.month}</p>
          </td>
          <td>₱${m.revenue.toLocaleString()}</td>
          <td><span class="status ${m.growth >= 0 ? 'completed' : 'pending'}">${m.growth >= 0 ? '+' : ''}${m.growth}%</span></td>
        </tr>
      `).join('');
    }

    // Update Top Services
    const todoList = document.querySelector('.todo-list');
    if (todoList && data.topServices) {
      todoList.innerHTML = data.topServices.map(s => `
        <li class="completed">
          <p>${s.name} - ${s.count}</p>
          <i class='bx bx-dots-vertical-rounded'></i>
        </li>
      `).join('');
    }
  } catch (err) {
    console.error('Analytics load failed:', err);
  }
}

// ============================
// Initialize on load
// ============================
document.addEventListener('DOMContentLoaded', function() {
  if (document.querySelector('#team-bookings')) {
    loadBookings();
  }

  // Dashboard page detection
  if (document.querySelector('.box-info') && document.querySelector('.breadcrumb a.active')?.textContent === 'Home') {
    loadDashboard();
  }

  // Analytics page detection
  if (document.querySelector('.breadcrumb a.active')?.textContent === 'Analytics') {
    loadAnalytics();
  }
});
