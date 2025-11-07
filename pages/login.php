<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Utils.php';
// Check if the user is logged in
if (isset($_SESSION['user_id'])) {
  header("Location: ./profile.php");
  exit();
}
$csrf = Utils::generateCSRFToken();
$flash = Utils::getFlashMessage();
// Backward compatibility: if any legacy auth_error exists, surface it once
if (!$flash && isset($_SESSION['auth_error'])) {
  $flash = ['message' => $_SESSION['auth_error'], 'type' => 'error'];
  unset($_SESSION['auth_error']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kabalayan - Log In</title>
  <link rel="stylesheet" href="../styles/theme.css">
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../styles/login.css">
</head>

<body class="no-theme-toggle">

<!-- LOGIN -->
  <div class="container">
    <form action="../php/auth.php" method="post" class="card">
      <h2>Login</h2>
      <?php if ($flash && $flash['type'] !== 'success'): ?>
        <div class="alert" style="color:#b00020; margin-bottom:10px;">&middot; <?php echo htmlspecialchars($flash['message']); ?></div>
      <?php endif; ?>
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf); ?>" />

      <div class="input-group">
        <input type="text" name="username" id="username" placeholder=" " required>
        <label for="username">Username</label>
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
  <script src="../js/theme.js"></script>
</body>

</html>