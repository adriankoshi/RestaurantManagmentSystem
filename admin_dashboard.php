<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>
<h1>Welcome to the Admin Dashboard</h1>
<a href="logout.php">Logout</a>
