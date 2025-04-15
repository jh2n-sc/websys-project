<?php
include '../php/db_conn.php';

$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

//defaults

$birthdate = '2000-12-12';
$gender = 'M';
$phoneNumber = '0999-999-9999';
$name = 'anonymous';

// Check if username or email already exists
$sql = "SELECT * FROM accounts WHERE username=? OR email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  echo "Username or email already exists!";
} else {
  $sql = "INSERT INTO accounts (email, username, account_password, birthdate, gender, phone_number, firstname, lastname) 
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $email, $username, $password, $birthdate, $gender, $phoneNumber, $name, $name);

  if ($stmt->execute()) {
    header("Location: index.html");
    exit();
  } else {
    echo "Error: " . $conn->error;
  }
}
?>
