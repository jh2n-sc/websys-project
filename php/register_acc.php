<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<pre>";
print_r($_POST); // <-- check if POST values are sent
echo "</pre>";

include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request method.");
}

// Required fields
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['firstname']) || empty($_POST['lastname'])) {
    die("Please fill out all fields.");
}

// Fetch values
$username = trim($_POST['username']);
$password = trim($_POST['password']);
$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);

// Dummy/defaults
$birthdate = '2000-01-01';
$gender = 'U';
$email = 'user@example.com';
$phone = '0000-000-0000';

// Check if username exists
$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    die("Username already exists!");
}

// Insert user
$sql = "INSERT INTO accounts (username, account_password, firstname, lastname, birthdate, gender, email, phone_number) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssssssss", $username, $password, $firstname, $lastname, $birthdate, $gender, $email, $phone);

if ($stmt->execute()) {
    echo "User created successfully!";
} else {
    echo "Error: " . $stmt->error;
}
?>
