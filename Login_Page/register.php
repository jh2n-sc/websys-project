<?php
include 'db.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// Check if username or email already exists
$sql = "SELECT * FROM users WHERE username=? OR email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "Username or email already exists!";
} else {
  $sql = "INSERT INTO users (email, username, password) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("sss", $email, $username, $password);

  if ($stmt->execute()) {
    header("Location: index.html");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
