const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
	const li = item.parentElement;

	item.addEventListener('click', function (e) {
		if (li.classList.contains('has-dropdown') || item.classList.contains('has-dropdown')) {
			e.preventDefault();
			li.classList.toggle('active');
			return;
		}
		allSideMenu.forEach(i => {
			i.parentElement.classList.remove('active');
		});
		li.classList.add('active');
	});
});

// Dynamic sidebar active highlight based on current page
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('#sidebar .side-menu li').forEach(li => li.classList.remove('active'));
    const currentPath = window.location.pathname.split('/').pop() || 'home.html';
    const allNavLinks = document.querySelectorAll('#sidebar a[href]');
    allNavLinks.forEach(item => {
        const li = item.closest('li');
        if (item.getAttribute('href') === currentPath) {
            li.classList.add('active');
            const accountLi = li.closest('#account-li');
            if (accountLi) accountLi.classList.add('active');
        }
    });
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

// Guest mode UI
function updateGuestMode() {
  const accountLi = document.getElementById('account-li');
  const logoutLi = document.querySelector('.logout');
  const profile = document.querySelector('.profile a');
  const navLink = document.querySelector('.nav-link');
  if (!AUTH.isLoggedIn()) {
    if (accountLi) {
      accountLi.title = 'Login required';
      accountLi.querySelector('.text').textContent = 'Guest';
    }
    if (navLink) navLink.textContent = 'Guest Mode';
    if (logoutLi) logoutLi.style.display = 'none';
    if (profile) profile.title = 'Login';
  } else {
    const user = AUTH.getCurrentUser();
    if (accountLi) accountLi.querySelector('.text').textContent = user.name;
    if (navLink) navLink.textContent = `Hi, ${user.name}`;
    if (logoutLi) logoutLi.style.display = 'block';
    if (profile) profile.title = user.name;
  }
}

/* Booking History Functionality - now backed by PHP API */
async function loadBookings() {
    const scheduleContent = document.getElementById('scheduleContent');
    const historyContent = document.getElementById('historyContent');
    if (!scheduleContent) return;

    let bookings = [];
    try {
        bookings = await AUTH.getUserBookings();
    } catch (err) {
        console.error('Failed to load bookings:', err);
        bookings = [];
    }

    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const upcoming = bookings.filter(booking => new Date(booking.date + 'T00:00:00') >= today);
    const history = bookings.filter(booking => new Date(booking.date + 'T00:00:00') < today);

    // Populate schedule (upcoming)
    if (upcoming.length > 0) {
        let upcomingHTML = '';
        upcoming.forEach(booking => {
            const date = new Date(booking.date + 'T00:00:00');
            const options = { weekday: 'short', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            const services = Array.isArray(booking.services) ? booking.services.map(s=>s.name).join(' + ') : (booking.service || '');
            upcomingHTML += `
                <div class="booking-details-card">
                    <div class="booking-header">
                        <div class="booking-id">#${booking.bookingId}</div>
                        <span class="booking-status">Upcoming</span>
                    </div>
                    <div class="booking-info">
                        <div class="info-item">
                            <i class='bx bx-scissors'></i>
                            <span><strong>Service:</strong> ${services}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-user'></i>
                            <span><strong>Stylist:</strong> ${booking.stylist || 'TBD'}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-calendar'></i>
                            <span><strong>Date & Time:</strong> ${formattedDate}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-money'></i>
                            <span><strong>Price:</strong> ₱${booking.totalCost?.toFixed(0) || '0'}</span>
                        </div>
                    </div>
                </div>
            `;
        });
        scheduleContent.innerHTML = upcomingHTML;
    } else {
        scheduleContent.innerHTML = `
            <p>No upcoming appointments</p>
            <button id="historyBtn" class="history-toggle-btn"><i class='bx bx-time-five'></i>View Booking History</button>
            <a href="appointment.html" class="btn-book">Book an Appointment</a>
        `;
        const newHistoryBtn = document.getElementById('historyBtn');
        if (newHistoryBtn) newHistoryBtn.addEventListener('click', toggleHistory);
    }

    // Populate history
    if (history.length > 0) {
        let historyHTML = '';
        history.forEach(booking => {
            const date = new Date(booking.date + 'T00:00:00');
            const options = { year: 'numeric', month: 'short', day: 'numeric' };
            const formattedDate = date.toLocaleDateString('en-US', options);
            const services = Array.isArray(booking.services) ? booking.services.map(s=>s.name).join(' + ') : (booking.service || '');
            historyHTML += `
                <div class="booking-details-card">
                    <div class="booking-header">
                        <div class="booking-id">#${booking.bookingId}</div>
                        <span class="booking-status completed">Completed</span>
                    </div>
                    <div class="booking-info">
                        <div class="info-item">
                            <i class='bx bx-scissors'></i>
                            <span><strong>Service:</strong> ${services}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-user'></i>
                            <span><strong>Stylist:</strong> ${booking.stylist || 'TBD'}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-calendar-check'></i>
                            <span><strong>Date:</strong> ${formattedDate}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-time'></i>
                            <span><strong>Time:</strong> ${booking.time}</span>
                        </div>
                        <div class="info-item">
                            <i class='bx bx-money'></i>
                            <span><strong>Price:</strong> ₱${booking.totalCost?.toFixed(0) || '0'}</span>
                        </div>
                    </div>
                    <div class="booking-slots">
                        <i class='bx bx-check-circle'></i>
                        <span>Service completed successfully</span>
                    </div>
                </div>
            `;
        });
        if (historyContent) historyContent.innerHTML = historyHTML;
    } else {
        if (historyContent) historyContent.innerHTML = '<p class="history-empty">No past bookings found. Your completed appointments will appear here.</p>';
    }
}

function toggleHistory() {
    const historySection = document.getElementById('historySection');
    const historyBtn = document.getElementById('historyBtn');
    const isVisible = historySection && (historySection.style.display === 'block' || historySection.classList.contains('show'));

    if (isVisible) {
        historySection.style.display = 'none';
        historySection.classList.remove('show');
        if (historyBtn) historyBtn.classList.remove('active');
        if (historyBtn) historyBtn.innerHTML = '<i class=\'bx bx-time-five\'></i>View Booking History';
    } else {
        if (historySection) historySection.style.display = 'block';
        if (historySection) setTimeout(() => historySection.classList.add('show'), 10);
        if (historyBtn) historyBtn.classList.add('active');
        if (historyBtn) historyBtn.innerHTML = '<i class=\'bx bx-chevron-up\'></i>Hide Booking History';
    }
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', async function() {
  await AUTH.init();
  if (document.body.classList.contains('protected') && !AUTH.isLoggedIn()) {
    window.location.href = 'login.html';
    return;
  }
  if (typeof initAuthNavbar === 'function') initAuthNavbar();
  const scripts = document.querySelectorAll('script[src*=\"modal.js\"]');
  if (scripts.length === 0) {
    const modalScript = document.createElement('script');
    modalScript.src = 'js/modal.js';
    document.head.appendChild(modalScript);
  }
  if (typeof loadBookings === 'function') {
    await loadBookings();
  }
  const historyBtn = document.getElementById('historyBtn');
  if (historyBtn) {
    historyBtn.addEventListener('click', toggleHistory);
  }
  updateGuestMode();
});

