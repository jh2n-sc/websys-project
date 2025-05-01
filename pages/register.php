<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>REGISTER</title>
  <link rel="stylesheet" href="../styles/login.css">
</head>
<body>
  <div class="container">
    <form action="../php/register_acc.php" method="post" class="card">
      <h2>Sign Up</h2>

      <div class="input-group">
        <input type="text" name="username" id="username" required>
        <label for="username">Username</label>
      </div>

      <div class="input-group">
        <input type="text" name="firstname" id="firstname" required>
        <label for="firstname">First Name</label>
      </div>

      <div class="input-group">
        <input type="text" name="lastname" id="lastname" required>
        <label for="lastname">Last Name</label>
      </div>

      <div class="input-group">
        <input type="password" name="password" id="password" required>
        <label for="password">Password</label>
        <span class="toggle" onclick="togglePassword()">👁</span>
      </div>

      <button type="submit">Register</button>
      <p>Already have an account? <a href="login.php">Login</a></p>
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
