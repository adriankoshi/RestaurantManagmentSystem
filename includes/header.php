<?php
session_start();
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="assets/images/icon.png">
    <title>Home | Restaurant</title>

    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

</head>
<body>
    <!-- Navbar -->
    <div class="navbar">
        <div class="logo">Restaurant</div>
        <div class="nav-items">
            <a href="#"><i class="fa fa-bell"></i></a>
            <a href="#"><i class="fa fa-envelope"></i></a>
            <div class="profile">
                <img src="https://via.placeholder.com/40" alt="Profile Picture" />
                <span><?php echo $_SESSION['username'];?></span>
                <ul>
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <li><a href="admin_dashboard.php">Go to Admin Dashboard</a></li>
    <?php endif; ?>
    <li><a href="handler/logout.php" id="logoutLink">Logout</a></li>
</ul>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('.profile').on('click', function(e) {
        
        e.stopPropagation();
        $(this).toggleClass('active');
    });

    $(document).on('click', function(e) {
        if (!$(e.target).closest('.profile').length) {
            $('.profile').removeClass('active');
        }
    });
});
</script>
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="index.php" id="Floor"><i class="icon fa fa-home"></i> <span>Floor</span></a>
        <a href="tables.php?ID=1" id="Tables"><i class="icon fa fa-th"></i> <span>Tables</span></a>
        <a href="users.php?ID=1" id="Users"><i class="icon fa fa-user-plus"></i> <span>Users</span></a>
        <a href="products.php?ID=1" id="Products"><i class="fa-brands fa-product-hunt"></i> <span>Products</span></a>
        <a href="orders.php" id="Orders"><i class="icon fa fa-chart-bar"></i> <span>Orders</span></a>
        <a href="support.php"><i class="icon fa fa-life-ring"></i> <span>Support</span></a>
        <a href="#"><i class="icon fa fa-gear"></i> <span>Settings</span></a>
    </div>
    
    <script>
        var userRole = <?php echo $_SESSION['role'];?>;
        if (userRole !== 4) { 
            document.getElementById('Tables').style.display = 'none';
            document.getElementById('Users').style.display = 'none';
            document.getElementById('Products').style.display = 'none';
            document.getElementById('Orders').style.display = 'none';
        }
    </script>
    <!-- Main Content -->
    <div class="main-content">