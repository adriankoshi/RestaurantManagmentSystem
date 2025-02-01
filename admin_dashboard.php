<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

require_once 'classes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'admin_sidebar.php'; ?>

<div class="admin-content">
    <h2>Welcome, Admin</h2>

    <div class="admin-grid">
        <div class="admin-card">
            <h4>Staff List</h4>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $config = new Database();
                    $conn = $config->getConnection();
                    $users_result = $conn->query("SELECT id, fullname, username, email, role FROM users");
                    while ($user = $users_result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['fullname']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo ucfirst($user['role']); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
