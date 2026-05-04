<?php
$page_title = 'Staff Dashboard';
$allowed_roles = ['staff'];
include '../header.php';
?>
<link rel="stylesheet" href="staff.css">
<style>
/* Staff-specific styles if needed */
</style>

<header>
    <h1>Staff Dashboard</h1>
    <nav>
        <button onclick="showSection('bookings')">Bookings</button>
        <button onclick="showSection('cancellations')">Cancellations</button>
        <button onclick="showSection('walkins')">Walk-ins</button>
        <button onclick="logoutStaff();" style="margin-left:auto;background:#dc3545;">Logout</button>
    </nav>
</header>

<main>
    <!-- Bookings Section -->
    <section id="bookings" class="section active">
        <h2>Pending Bookings</h2>
        <?php
        // Dynamic bookings from api/data
        $bookings = json_decode(file_get_contents('../data/bookings.json'), true) ?? [];
        $pending_bookings = array_filter($bookings, fn($b) => $b['status'] === 'pending');
        ?>
        <table id="bookingsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_bookings as $booking): ?>
                <tr>
                    <td><?php echo htmlspecialchars($booking['id']); ?></td>
                    <td><?php echo htmlspecialchars($booking['customer']); ?></td>
                    <td><?php echo htmlspecialchars($booking['date']); ?></td>
                    <td><?php echo htmlspecialchars($booking['service']); ?></td>
                    <td><span class="status pending">Pending</span></td>
                    <td>
                        <button onclick="confirmBooking('<?php echo $booking['id']; ?>')">Confirm</button>
                        <button onclick="rejectBooking('<?php echo $booking['id']; ?>')">Reject</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Cancellations Section -->
    <section id="cancellations" class="section">
        <h2>Pending Cancellations</h2>
        <?php
        $cancellations = json_decode(file_get_contents('../data/cancellations.json'), true) ?? [];
        $pending_canc = array_filter($cancellations, fn($c) => $c['status'] === 'pending');
        ?>
        <table id="cancellationsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Booking ID</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pending_canc as $canc): ?>
                <tr>
                    <td><?php echo htmlspecialchars($canc['id']); ?></td>
                    <td><?php echo htmlspecialchars($canc['customer']); ?></td>
                    <td><?php echo htmlspecialchars($canc['booking_id']); ?></td>
                    <td><?php echo htmlspecialchars($canc['reason']); ?></td>
                    <td><span class="status pending">Pending</span></td>
                    <td>
                        <button onclick="approveCancel('<?php echo $canc['id']; ?>')">Approve</button>
                        <button onclick="denyCancel('<?php echo $canc['id']; ?>')">Deny</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <!-- Walk-ins Section -->
    <section id="walkins" class="section">
        <h2>Walk-in Customers</h2>
        <form id="walkinForm" action="../api/walkins.php" method="POST">
            <input type="text" name="customer_name" id="customerName" placeholder="Customer Name" required>
            <input type="tel" name="phone" id="customerPhone" placeholder="Phone" required>
            <input type="email" name="email" id="customerEmail" placeholder="Email">
            <input type="text" name="service" id="serviceNeeded" placeholder="Service Needed" required>
            <textarea name="notes" id="notes" placeholder="Notes"></textarea>
            <button type="submit">Add Walk-in</button>
        </form>
        <?php
        $walkins = json_decode(file_get_contents('../data/walkins.json'), true) ?? [];
        ?>
        <table id="walkinsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Service</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($walkins as $walkin): ?>
                <tr>
                    <td><?php echo htmlspecialchars($walkin['id']); ?></td>
                    <td><?php echo htmlspecialchars($walkin['customer']); ?></td>
                    <td><?php echo htmlspecialchars($walkin['phone']); ?></td>
                    <td><?php echo htmlspecialchars($walkin['service']); ?></td>
                    <td><span class="status <?php echo $walkin['status']; ?>"><?php echo ucfirst($walkin['status']); ?></span></td>
                    <td>
                        <?php if ($walkin['status'] === 'pending'): ?>
                        <button onclick="processWalkin('<?php echo $walkin['id']; ?>')">Process</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>

<script src="../js/auth.js"></script>
<script>
    // Server-side protection already done, JS enhancement
    function logoutStaff() {
        fetch('../api/logout.php', {method: 'POST'})
            .then(() => window.location.href = '../login.php');
    }
    function confirmBooking(id) {
        if (confirm('Confirm this booking?')) {
            fetch('../api/bookings.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({action: 'confirm', id})
            }).then(() => location.reload());
        }
    }
    // Similar for reject, approve etc.
</script>
<script src="staff.js"></script>

<?php include '../footer.php'; ?>
