<div class="admin-sidebar">
    <h2>Admin Panel</h2>
    <ul>
        <li><a href="admin_dashboard.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'admin_dashboard.php') ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="manage_users.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'manage_users.php') ? 'active' : '' ?>">Manage Users</a></li>
        <li><a href="manage_bookings.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'manage_bookings.php') ? 'active' : '' ?>">Manage Bookings</a></li>
        <li><a href="index.php" target="_blank">Go to User View</a></li>
        <li><a href="login.php" class="logout">Logout</a></li>
    </ul>
</div>
