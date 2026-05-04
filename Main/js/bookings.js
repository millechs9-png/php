// Shared booking utilities - now backed by PHP API

const BOOKING_API = (() => {
  const API_BASE = (() => {
    const depth = window.location.pathname.split('/').filter(Boolean).length - 1;
    return '../'.repeat(depth) + 'api/';
  })();

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

  return {
    getAll() { return apiFetch('bookings.php'); },
    add(booking) { return apiFetch('bookings.php', { method: 'POST', body: JSON.stringify(booking) }); },
    updateStatus(bookingId, status) {
      return apiFetch('bookings.php', { method: 'PUT', body: JSON.stringify({ bookingId, status }) });
    },
    delete(bookingId) {
      return apiFetch('bookings.php', { method: 'DELETE', body: JSON.stringify({ bookingId }) });
    }
  };
})();

// Legacy compatibility wrappers (now async, callers need to await)
function getAllBookings() {
  return BOOKING_API.getAll();
}

function saveAllBookings(bookings) {
  // No direct save-all in REST API; individual calls handled by add/update/delete
  return Promise.resolve();
}

function updateBookingStatus(bookingId, newStatus) {
  return BOOKING_API.updateStatus(bookingId, newStatus);
}

function cancelBooking(bookingId) {
  return BOOKING_API.updateStatus(bookingId, 'cancelled');
}

// Render helpers (unchanged)
function renderBookingItem(booking) {
  let iconClass = 'bx bx-calendar-check';
  let statusClass = 'confirmed';
  let statusText = 'Confirmed';

  if (booking.status === 'pending') {
    iconClass = 'bx bx-calendar-clock';
    statusClass = 'pending';
    statusText = 'Pending Approval';
  } else if (booking.status === 'completed') {
    iconClass = 'bx bx-check-circle';
    statusClass = 'completed';
    statusText = 'Completed';
  } else if (booking.status === 'cancelled') {
    iconClass = 'bx bx-x-circle';
    statusClass = 'cancelled';
    statusText = 'Cancelled';
  }

  const dateObj = new Date(booking.date + 'T00:00:00');
  const dateStr = !isNaN(dateObj) ? dateObj.toLocaleDateString('en-US', {
    weekday: 'short', year: 'numeric', month: 'short', day: 'numeric'
  }) : booking.date;

  const services = Array.isArray(booking.services)
    ? booking.services.map(s => s.name).join(' + ')
    : (booking.service || '');

  return `
    <div class="booking-item" data-booking-id="${booking.bookingId}">
      <div class="booking-icon ${statusClass}">
        <i class="${iconClass}"></i>
      </div>
      <div class="booking-content">
        <h4>${services}<br>#${booking.bookingId}</h4>
        <p>${dateStr} at ${booking.time} with ${booking.stylist || 'TBD'}</p>
        <div class="booking-status ${statusClass}">${statusText}</div>
        <span class="booking-price">₱${booking.totalCost?.toFixed(0) || '0'}</span>
      </div>
      <div class="booking-actions">
        ${booking.status === 'pending'
          ? `<button class="btn-cancel" onclick="window.cancelBooking('${booking.bookingId}')">Cancel</button>`
          : `
            <button class="btn-view">View Details</button>
            <button class="btn-cancel">Rebook</button>
          `}
      </div>
  `;
}

async function loadMyBookings() {
  try {
    const bookings = await BOOKING_API.getAll();
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    const pending = bookings.filter(b => b.status === 'pending');
    const confirmed = bookings.filter(b => b.status === 'confirmed');
    const history = bookings.filter(b => b.status === 'completed' || b.status === 'cancelled');

    const pendingEl = document.querySelector('.booking-section[data-type="pending"]');
    const confirmedEl = document.querySelector('.booking-section[data-type="confirmed"]');
    const historyEl = document.querySelector('.booking-section[data-type="history"]');
    const emptyState = document.getElementById('emptyBookingsState');

    if (pendingEl) pendingEl.innerHTML = pending.length ? pending.map(renderBookingItem).join('') : '<p class="no-bookings">No pending bookings</p>';
    if (confirmedEl) confirmedEl.innerHTML = confirmed.length ? confirmed.map(renderBookingItem).join('') : '<p class="no-bookings">No confirmed bookings</p>';
    if (historyEl) historyEl.innerHTML = history.length ? history.map(renderBookingItem).join('') : '<p class="no-bookings">No history yet</p>';

    if (emptyState) {
      emptyState.style.display = bookings.length > 0 ? 'none' : '';
    }
  } catch (err) {
    console.error('Failed to load bookings:', err);
  }
}

// Expose globals for onclick
window.cancelBooking = async function(bookingId) {
  if (confirm('Cancel this booking?')) {
    try {
      await BOOKING_API.updateStatus(bookingId, 'cancelled');
      await loadMyBookings();
    } catch (err) {
      alert(err.message);
    }
  }
};
