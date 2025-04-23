<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_conn.php';

$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$birthdate = '2000-01-01';
$gender = 'U';
$email = 'user@example.com';
$phone = '0000-000-0000';

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
  $sql = "INSERT INTO accounts (username, account_password, firstname, lastname, birthdate, gender, email, phone_number) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $username, $password, $firstname, $lastname, $birthdate, $gender, $email, $phone);

  if ($stmt->execute()) {
    header("Location: index.php");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
