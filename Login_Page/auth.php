<?php
include 'db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Check if user exists
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
    $_SESSION['user_id'] = $user['account_id']; 
    $_SESSION['username'] = $user['username'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['photo'] = $user['photo'];
    $_SESSION['phone_number'] = $user['phone_number'];
    $_SESSION['location'] = $user['location'];

    header("Location: http://localhost/websysprojbuynsell/websys-project/home/home.html");
    exit();
  } else {
    echo "Incorrect password.";
  }
} else {
  echo "User not found.";
}
?>
