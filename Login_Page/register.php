<?php
include 'db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Check if the username already exists
$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "Username already exists!";
} else {
  // Insert the new user into the database
  $sql = "INSERT INTO accounts (id, username, account_password, firstname, lastname, birthdate, gender, email, phone) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
  $stmt->bind_param("ss", $username, $password);

  if ($stmt->execute()) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
