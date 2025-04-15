<?php
include '../php/db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM accounts WHERE username=? OR email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  if (password_verify($password, $user['account_password'])) {
    header("Location: dashboard.php");
    exit();
  } else {
    echo "Incorrect password.";
  }
} else {
  echo "User not found.";
}
?>
