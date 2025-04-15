<?php
include 'db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Check if the user exists
$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();

  // Check if passwords match
  if ($password === $user['account_password']) {
    session_start();
    $_SESSION['username'] = $user['username'];
    header("Location: http://localhost/websysprojbuynsell/websys-project/home/home.html");    exit();
  } else {
    echo "Incorrect password.";
  }
} else {
  echo "User not found.";
}
?>
