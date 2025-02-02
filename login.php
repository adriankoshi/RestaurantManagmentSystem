<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
  <div class="login-form">
    <div class="form-container">
      <h1>Login</h1>
      <form id="loginForm">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Login</button>
      </form>
      <p>Don't have an account? <a href="signup.html">Sign up here</a></p>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#loginForm').on('submit', function(e) {
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
          url: 'handler/login_handler.php',
          method: 'POST',
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.status === 'success') {
              window.location.href = 'index.php';
            } else {
              alert(response.message);
            }
          },
          error: function() {
            alert('An error occurred. Please try again.');
          }
        });
      });
    });
  </script>
</body>
</html>
