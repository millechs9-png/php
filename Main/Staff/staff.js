// Staff Dashboard - PHP API Client

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

// Data state (populated from server)
let bookings = [];
let cancellations = [];
let walkins = [];

async function loadAllData() {
  try {
    [bookings, cancellations, walkins] = await Promise.all([
      apiFetch('bookings.php'),
      apiFetch('cancellations.php'),
      apiFetch('walkins.php')
    ]);
    renderBookings();
    renderCancellations();
    renderWalkins();
  } catch (err) {
    console.error('Failed to load data:', err);
    if (err.message.includes('token') || err.message.includes('Unauthorized')) {
      alert('Session expired. Please log in again.');
      window.location.href = '../login.html';
    }
  }
}

// Show section
function showSection(sectionId) {
    document.querySelectorAll('.section').forEach(s => s.classList.remove('active'));
    document.getElementById(sectionId).classList.add('active');
    document.querySelectorAll('nav button').forEach(btn => btn.classList.remove('active'));
    if (event && event.target) event.target.classList.add('active');
    if (sectionId === 'bookings') renderBookings();
    if (sectionId === 'cancellations') renderCancellations();
    if (sectionId === 'walkins') renderWalkins();
}

// Render bookings table
function renderBookings() {
    const tbody = document.querySelector('#bookingsTable tbody');
    if (!tbody) return;
    tbody.innerHTML = '';
    bookings.filter(b => b.status === 'pending').forEach(booking => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td data-label="ID">${booking.id}</td>
            <td data-label="Customer">${booking.customer}</td>
            <td data-label="Date">${booking.date}</td>
            <td data-label="Service">${Array.isArray(booking.services) ? booking.services.map(s=>s.name).join(' + ') : booking.service}</td>
            <td data-label="Status"><span class="status status-${booking.status}">${booking.status.toUpperCase()}</span></td>
            <td data-label="Actions">
                <button class="btn-approve" onclick="updateStatus('bookings', ${booking.id}, 'approved')">Approve</button>
                <button class="btn-reject" onclick="updateStatus('bookings', ${booking.id}, 'rejected')">Reject</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Render cancellations
function renderCancellations() {
    const tbody = document.querySelector('#cancellationsTable tbody');
    if (!tbody) return;
    tbody.innerHTML = '';
    cancellations.filter(c => c.status === 'pending').forEach(cancel => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td data-label="ID">${cancel.id}</td>
            <td data-label="Customer">${cancel.customer}</td>
            <td data-label="Booking ID">${cancel.bookingId}</td>
            <td data-label="Reason">${cancel.reason}</td>
            <td data-label="Status"><span class="status status-${cancel.status}">${cancel.status.toUpperCase()}</span></td>
            <td data-label="Actions">
                <button class="btn-approve" onclick="updateStatus('cancellations', ${cancel.id}, 'approved')">Approve</button>
                <button class="btn-reject" onclick="updateStatus('cancellations', ${cancel.id}, 'rejected')">Reject</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Render walk-ins
function renderWalkins() {
    const tbody = document.querySelector('#walkinsTable tbody');
    if (!tbody) return;
    tbody.innerHTML = '';
    walkins.filter(w => w.status === 'pending').forEach(walkin => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td data-label="ID">${walkin.id}</td>
            <td data-label="Customer">${walkin.customer}</td>
            <td data-label="Phone">${walkin.phone}</td>
            <td data-label="Service">${walkin.service}</td>
            <td data-label="Status"><span class="status status-${walkin.status}">${walkin.status.toUpperCase()}</span></td>
            <td data-label="Actions">
                <button class="btn-approve" onclick="updateStatus('walkins', ${walkin.id}, 'approved')">Serve</button>
                <button class="btn-reject" onclick="updateStatus('walkins', ${walkin.id}, 'rejected')">Reject</button>
            </td>
        `;
        tbody.appendChild(tr);
    });
}

// Update status via API
async function updateStatus(type, id, newStatus) {
    try {
        if (type === 'bookings') {
            const item = bookings.find(b => b.id === id);
            if (item) {
                await apiFetch('bookings.php', { method: 'PUT', body: JSON.stringify({ bookingId: item.bookingId, status: newStatus }) });
                await loadAllData();
            }
        } else if (type === 'cancellations') {
            await apiFetch('cancellations.php', { method: 'PUT', body: JSON.stringify({ id, status: newStatus }) });
            await loadAllData();
        } else if (type === 'walkins') {
            await apiFetch('walkins.php', { method: 'PUT', body: JSON.stringify({ id, status: newStatus }) });
            await loadAllData();
        }
    } catch (err) {
        alert(err.message);
    }
}

// Walk-in form submit
document.getElementById('walkinForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    const newWalkin = {
        customer: document.getElementById('customerName').value,
        phone: document.getElementById('customerPhone').value,
        email: document.getElementById('customerEmail').value,
        service: document.getElementById('serviceNeeded').value,
        notes: document.getElementById('notes').value
    };
    try {
        await apiFetch('walkins.php', { method: 'POST', body: JSON.stringify(newWalkin) });
        await loadAllData();
        this.reset();
    } catch (err) {
        alert(err.message);
    }
});

// Init
document.addEventListener('DOMContentLoaded', function() {
    showSection('bookings');
    loadAllData();
});
