<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kabalayan - About Us</title>
  <link rel="stylesheet" href="../styles/theme.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Use stable Devicon CSS from npm (icons for HTML/CSS/JS/Apache/MySQL) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/devicon@2.15.1/devicon.min.css" />
  <!-- Fallback: Devicon from cdnjs -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/devicon/2.15.1/devicon.min.css" integrity="sha512-mQdHq6pP4Y+vQW+M8gkW4qQqY1dGqrM1R5XyH8lQq9vXJ+2e1r3v9wq7d3+KxVFDmWkSgkS9F8u7pQvYxHq6WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../styles/about.css" />
</head>

<body>

  <!-- LOADER -->
  <?php include '../Includes/loader.php'; ?>
  <!-- NAV -->
  <?php include '../Includes/navbar.php'; ?>


  <!-- ABOUT -->
  <div class="about">
    <div class="title">
      <h2>About Us</h2>
    </div>
    <div class="descript">
      <p>KABALAYAN – your trusted platform for seamless property buying and selling. Whether you're searching for your dream home, looking to invest,
        or aiming to sell quickly for the best price, we connect you to verified listings and expert tools. With advanced search filters, real-time alerts,
        and a network of trusted agents, we make every transaction simple, transparent, and stress-free. Experience the future of real estate – where smart
        deals happen faster.</p>
    </div>
  </div>


  <!-- TEAM SECTION -->
  <div class="team-section">
    <h2>Meet Our Team</h2>
    <div class="team-grid">
      <div class="team-member">
        <img src="../Assets/images/Jerve.jpg" alt="Sean Jerve" class="member-photo">
        <div class="member-name">Sean Jerve Rebancos</div>
        <div class="member-title">Student</div>
        <div class="member-location">Daraga, Albay</div>
      </div>
    </div>
  </div>


  <!-- TECH STACK  -->
  <div class="stacks">
    <div class="Title">
      <h2> Our Tech </h2>
    </div>
    <div class="tech-stack">
      <div class="tech-item"><i class="devicon-html5-plain colored"></i></div>
      <div class="tech-item"><i class="devicon-php-plain colored"></i></div>
      <div class="tech-item"><i class="devicon-javascript-plain colored"></i></div>
      <div class="tech-item"><i class="devicon-css3-plain colored"></i></div>
      <div class="tech-item"><i class="devicon-mysql-original colored"></i></i></div>
      <div class="tech-item"><i class="devicon-apache-plain colored"></i></div>
    </div>
  </div>

  <!-- TOP-BUTTON -->
  <?php include '../Includes/top-button.php'; ?>

  <!-- FOOTER -->
  <?php include '../Includes/footer.php'; ?>


  <script src="../js/theme.js"></script>
  <script src="../js/about.js"></script>

</body>

</html>