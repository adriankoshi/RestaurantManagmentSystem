<?php
include '../user.php';

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isLoggedIn = $user->login($_POST['username'], $_POST['password']);
    if ($isLoggedIn) {
        if ($_SESSION['role'] == 'admin') {
            header("Location: admin_dashboard.php");
            exit;
        } else {
            header("Location: user_dashboard.php");
            exit;
        }
    } else {
        echo "<script>alert('Login failed! Please check your username and password and try again.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Restaurant Management System</title>
    <link rel="stylesheet" href="style/form.css" />
  </head>
  <body>
    <div class="form-container">
      <h1>Login</h1>
      <h2>Welcome back!</h2>
      <form id="loginForm" method="post" action="login.php">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required placeholder="Enter your username..." />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password" />

        <button type="submit">Login</button>
      </form>
      <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
    <footer>
      <p>© 2024 Restaurant Management System. All Rights Reserved.</p>
    </footer>
    <script src="form.js"></script>
  </body>
</html>
