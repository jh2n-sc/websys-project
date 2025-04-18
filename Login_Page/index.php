<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  header("Location: ../Profile/Profile.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <form action="auth.php" method="post" class="card">
      <h2>Login</h2>

      <div class="input-group">
        <input type="text" name="username" id="username" required>
        <label for="username">Email or Username</label>
      </div>

      <div class="input-group">
        <input type="password" name="password" id="password" required>
        <label for="password">Password</label>
        <span class="toggle" onclick="togglePassword()">👁</span>
      </div>

      <button type="submit">Login</button>
      <p>Don't have an account? <a href="register.html">Sign Up</a></p>
    </form>
  </div>

  <script>
    function togglePassword() {
      const pwd = document.getElementById('password');
      pwd.type = pwd.type === 'password' ? 'text' : 'password';
    }
  </script>
</body>
</html>


