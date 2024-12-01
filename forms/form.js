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

  const signupForm = document.getElementById("signupForm");
  if (signupForm) {
    signupForm.addEventListener("submit", function (event) {
      const fullName = document.getElementById("fullname").value.trim();
      const email = document.getElementById("email").value.trim();
      const username = document.getElementById("username").value.trim();
      const password = document.getElementById("password").value.trim();
      const confirmPassword = document
        .getElementById("confirmPassword")
        .value.trim();

      if (
        fullName === "" ||
        email === "" ||
        username === "" ||
        password === "" ||
        confirmPassword === ""
      ) {
        alert("Please fill in all fields.");
        event.preventDefault();
        return;
      }

      if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        event.preventDefault();
        return;
      }

      if (password !== confirmPassword) {
        alert("Passwords do not match.");
        event.preventDefault();
      }
    });
  }
});
