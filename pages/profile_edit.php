<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../includes/Utils.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit;
}

$pdo = Database::getInstance()->getConnection();
$stmt = $pdo->prepare('SELECT username, email, firstname, lastname, phone_number, photo FROM accounts WHERE account_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
if (!$user) {
    Utils::redirect('./login.php', 'User not found. Please log in again.', 'error');
}
$csrf = Utils::generateCSRFToken();
$flash = Utils::getFlashMessage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile - <?php echo htmlspecialchars($user['username']); ?></title>
  <link rel="stylesheet" href="../styles/theme.css">
  <link rel="stylesheet" href="../styles/profile.css">
  <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
  <?php include '../Includes/navbar.php'; ?>
  <div class="container">
    <h2>Edit Profile</h2>
    <?php if ($flash): ?>
      <div class="alert" style="margin: 10px 0; color: <?php echo $flash['type']==='success'?'#0a7d2b':'#b00020'; ?>;">
        <?php echo htmlspecialchars($flash['message']); ?>
      </div>
    <?php endif; ?>
    <form class="card" action="../php/profile_update.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf); ?>" />
      <div class="input-group">
        <label>Username</label>
        <input type="text" value="<?php echo htmlspecialchars($user['username']); ?>" disabled />
      </div>
      <div class="input-group">
        <label for="firstname">First name</label>
        <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($user['firstname']); ?>" required />
      </div>
      <div class="input-group">
        <label for="lastname">Last name</label>
        <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($user['lastname']); ?>" required />
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" />
      </div>
      <div class="input-group">
        <label for="phone_number">Phone</label>
        <input type="tel" id="phone_number" name="phone_number" pattern="[0-9]{11}" value="<?php echo htmlspecialchars($user['phone_number']); ?>" />
      </div>
      <div class="input-group">
        <label for="photo">Profile photo</label>
        <?php if (!empty($user['photo'])): ?>
          <div style="margin-bottom:8px"><img src="<?php echo htmlspecialchars($user['photo']); ?>" alt="Current photo" style="width:72px;height:72px;border-radius:50%;object-fit:cover"/></div>
        <?php endif; ?>
        <input type="file" id="photo" name="photo" accept="image/*" />
      </div>
      <div style="margin-top:12px; display:flex; gap:8px;">
        <button type="submit" class="btn">Save Changes</button>
        <a href="./profile.php" class="btn" style="background:#ccc;color:#222;">Cancel</a>
      </div>
    </form>
  </div>
  <?php include '../Includes/footer.php'; ?>
</body>
</html>
