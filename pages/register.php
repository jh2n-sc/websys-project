</html><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kabalayan - Register</title>
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../styles/login.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>

  <!-- REGISTER -->
  <div class="container">
    <form action="../php/register_acc.php" method="post" class="card register-card" enctype="multipart/form-data" id="registerForm">
      <h2>Sign Up</h2>

      <div class="card-content">
        <div class="input-group">
          <input type="text" name="username" id="username" placeholder=" " required>
          <label for="username">Username</label>
          <div class="error-message">Please enter a valid username (3-20 characters)</div>
        </div>

        <div class="input-group">
          <input type="text" name="firstname" id="firstname" placeholder=" " required>
          <label for="firstname">First Name</label>
          <div class="error-message">Please enter your first name</div>
        </div>

        <div class="input-group">
          <input type="text" name="lastname" id="lastname" placeholder=" " required>
          <label for="lastname">Last Name</label>
          <div class="error-message">Please enter your last name</div>
        </div>

        <div class="input-group">
          <input type="email" name="email" id="email" placeholder=" " required>
          <label for="email">Email Address</label>
          <div class="error-message">Please enter a valid email address</div>
        </div>

        <div class="input-group">
          <input type="tel" name="phone_number" id="phone_number" placeholder=" " pattern="[0-9]{11}" required>
          <label for="phone_number">Phone Number</label>
          <div class="error-message">Please enter a valid phone number (11 digits)</div>
        </div>

        <div class="input-group">
          <input type="date" name="birthdate" id="birthdate" placeholder=" " required>
          <label for="birthdate">Birth Date</label>
          <div class="error-message">Please select your birth date</div>
        </div>

        <div class="input-group">
          <div class="select-wrapper">
            <select name="gender" id="gender" required>
              <option value="" disabled selected></option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
              <option value="prefer_not_to_say">Prefer not to say</option>
            </select>
            <label for="gender">Gender</label>
          </div>
          <div class="error-message">Please select your gender</div>
        </div>

        <div class="input-group">
          <div class="file-input-wrapper" id="photoWrapper">
            <input type="file" name="photo" id="photo" accept="image/*">
            <span class="file-name">Choose Profile Photo</span>
            <label class="file-label" for="photo"></label>
          </div>
          <div class="error-message">Please select a valid image file</div>
        </div>

        <div class="input-group">
          <input type="password" name="password" id="password" placeholder=" " required minlength="8">
          <label for="password">Password</label>
          <span class="toggle" onclick="togglePassword('password')">👁</span>
          <div class="error-message">Password must be at least 8 characters</div>
        </div>

        <div class="input-group">
          <input type="password" name="confirm_password" id="confirm_password" placeholder=" " required>
          <label for="confirm_password">Confirm Password</label>
          <span class="toggle" onclick="togglePassword('confirm_password')">👁</span>
          <div class="error-message">Passwords don't match</div>
        </div>
      </div>

      <button type="submit">Register</button>
      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>

  <script>
    // Toggle password visibility
    function togglePassword(fieldId) {
      const pwd = document.getElementById(fieldId);
      pwd.type = pwd.type === 'password' ? 'text' : 'password';
    }

    // Handle file input display
    document.getElementById('photo').addEventListener('change', function(e) {
      const fileName = e.target.files[0] ? e.target.files[0].name : 'No file chosen';
      const wrapper = document.getElementById('photoWrapper');

      wrapper.querySelector('.file-name').textContent = fileName;

      if (fileName !== 'No file chosen') {
        wrapper.classList.add('has-file');
      } else {
        wrapper.classList.remove('has-file');
      }
    });

    // Move labels up when date field is filled
    document.getElementById('birthdate').addEventListener('change', function() {
      if (this.value) {
        this.classList.add('filled');
      } else {
        this.classList.remove('filled');
      }
    });

    // Form validation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
      let isValid = true;

      // Username validation
      const username = document.getElementById('username');
      if (username.value.length < 3 || username.value.length > 20) {
        username.parentElement.classList.add('error');
        isValid = false;
      } else {
        username.parentElement.classList.remove('error');
      }

      // Email validation
      const email = document.getElementById('email');
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email.value)) {
        email.parentElement.classList.add('error');
        isValid = false;
      } else {
        email.parentElement.classList.remove('error');
      }

      // Phone validation
      const phone = document.getElementById('phone_number');
      if (phone.value.length !== 11 || !/^\d+$/.test(phone.value)) {
        phone.parentElement.classList.add('error');
        isValid = false;
      } else {
        phone.parentElement.classList.remove('error');
      }

      // Password validation
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('confirm_password');

      if (password.value.length < 8) {
        password.parentElement.classList.add('error');
        isValid = false;
      } else {
        password.parentElement.classList.remove('error');
      }

      if (password.value !== confirmPassword.value) {
        confirmPassword.parentElement.classList.add('error');
        isValid = false;
      } else {
        confirmPassword.parentElement.classList.remove('error');
      }

      if (!isValid) {
        e.preventDefault();
      }
    });

    // Initialize fields that might have values (like on form errors)
    window.addEventListener('DOMContentLoaded', (event) => {
      // Check date field
      const dateField = document.getElementById('birthdate');
      if (dateField.value) {
        dateField.classList.add('filled');
      }

      // Check file field
      const fileInput = document.getElementById('photo');
      if (fileInput.files.length > 0) {
        const wrapper = document.getElementById('photoWrapper');
        wrapper.querySelector('.file-name').textContent = fileInput.files[0].name;
        wrapper.classList.add('has-file');
      }
    });
  </script>

</body>

</html>