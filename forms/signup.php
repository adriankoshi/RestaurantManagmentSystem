<?php
include '../user.php';

$user = new User();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $result = $user->register($_POST['fullname'], $_POST['email'], $_POST['username'], $_POST['password']);
    if ($result) {
        echo "<script>alert('Registration successful!'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registration failed!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign Up - Restaurant Management System</title>
    <link rel="stylesheet" href="style/form.css" />
  </head>
  <body>
    <div class="form-container">
      <form id="signupForm" method="post" action="signup.php">
        <h1>Sign Up</h1>
        <label for="fullname">Full Name:</label>
        <input type="text" id="fullname" name="fullname" required placeholder="Enter your full name..." />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Enter your email..." />

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required placeholder="Enter your username..." />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password..." />

        <label for="confirmPassword">Confirm Password:</label>
        <input type="password" id="confirmPassword" name="confirmPassword" required placeholder="Confirm password..." />

        <button type="submit">Sign Up</button>
      </form>
      <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
    <footer>
      <p>© 2024 Restaurant Management System. All Rights Reserved.</p>
    </footer>
    <script src="form.js"></script>
  </body>
</html>
