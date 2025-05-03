<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  header("Location: ./pages/profile.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kabalayan - Log In</title>
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../styles/login.css">
</head>

<body>

<!-- LOGIN -->
  <div class="container">
    <form action="../php/auth.php" method="post" class="card">
      <h2>Login</h2>

      <div class="input-group">
        <input type="text" name="username" id="username" placeholder=" " required>
        <label for="username">Email or Username</label>
      </div>

      <div class="input-group">
        <input type="password" name="password" id="password" placeholder=" " required>
        <label for="password">Password</label>
        <span class="toggle" onclick="togglePassword()">👁</span>
      </div>

      <button type="submit">Login</button>
      <p>Don't have an account? <a href="./register.php">Sign Up</a></p>
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