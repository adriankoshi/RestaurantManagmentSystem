<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - Restaurant Management System</title>
  <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
  <div class="login-form">
    <div class="form-container">
      <h1>Login</h1>
      <h2>Welcome back!</h2>
      <form id="loginForm">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required />

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required />

        <button type="submit">Login</button>
      </form>
      <p>
        Don't have an account?
        <a href="signup.html">Sign up here</a>
      </p>
    </div>
  </div>
  <script>

    document.addEventListener("DOMContentLoaded", function () {
      const loginForm = document.getElementById("loginForm");
      if (loginForm) {
        loginForm.addEventListener("submit", function (event) {
          const username = document.getElementById("username").value.trim();
          const password = document.getElementById("password").value.trim();

          if (username === "" || password === "") {
            alert("Please fill in all fields.");
            event.preventDefault();
          }
        });
      }
    });
  </script>
</body>

</html>