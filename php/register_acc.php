<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
$birthdate = !empty($_POST['birthdate']) ? trim($_POST['birthdate']) : null;
$gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
$email = !empty($_POST['email']) ? trim($_POST['email']) : null;
$phone = !empty($_POST['phone_number']) ? trim($_POST['phone_number']) : null;

// Handle file upload
$photoPath = null;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../uploads/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
    $targetPath = $uploadDir . $filename;

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $targetPath)) {
        $photoPath = $targetPath;
    }
}

// Check if username exists
$sql = "SELECT * FROM accounts WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Username exists 
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="icon" href="../favicon.ico" type="image/x-icon">    
        <!-- Your existing CSS here -->
    </head>
    <body>
        <div class="success-container">
            <div class="success-icon error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h1 class="success-title">Error</h1>
            <p class="success-message">Username already exists!</p>
            <a href="../pages/register.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Try Again
            </a>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "../pages/register.php";
            }, 5000);
        </script>
    </body>
    </html>';
    exit();
}

// Insert user
$sql = "INSERT INTO accounts (username, account_password, firstname, lastname, birthdate, gender, email, phone_number, photo)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("sssssssss", $username, $password, $firstname, $lastname, $birthdate, $gender, $email, $phone, $photoPath);

if ($stmt->execute()) {
    // Success
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account Created</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="icon" href="./favicon.ico" type="image/x-icon">    

        <style>
            :root {
                --primary: #000000;
                --primary-dark: #000000;
                --secondary: #000000;
                --text-dark: #2d3b45;
                --text-medium: #5d6974;
                --bg-white: #ffffff;
                --bg-light: #f7f9fc;
                --bg-accent: #EFF3FF;
                --border: #e5e8ed;
                --error: #e74c3c;
                --shadow-sm: 0 20px 80px rgba(0, 0, 0, 0.05);
                --shadow-md: 0 5px 15px rgba(0, 0, 0, 0.08);
                --transition: all 0.3s ease;
            }

            body {
                font-family: Inter, sans-serif;
                background: linear-gradient(-45deg, black, white, black, white);
  background-size: 400% 400%;
  animation: gradientBG 10s ease infinite;

                color: var(--text-dark);
                line-height: 1.6;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

              @keyframes gradientBG {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

            .success-container {
                background-color: var(--bg-white);
                border-radius: 12px;
                box-shadow: var(--shadow-md);
                padding: 40px;
                max-width: 500px;
                width: 70%;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .success-container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, var(--primary), var(--secondary));
            }

            .success-icon {
                font-size: 60px;
                color: #4CAF50;
                margin-bottom: 20px;
            }

            .error-icon {
                color: var(--error);
            }

            .success-title {
                font-size: 26px;
                font-weight: 700;
                margin-bottom: 15px;
                color: var(--text-dark);
            }

            .success-message {
                color: var(--text-medium);
                font-size: 16px;
                margin-bottom: 25px;
            }

            .user-details {
                background-color: var(--bg-accent);
                border-radius: 8px;
                padding: 20px;
                margin: 20px 0;
                text-align: left;
            }

            .user-detail {
                margin-bottom: 10px;
            }

            .user-detail strong {
                color: var(--text-dark);
                font-weight: 600;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 25px;
                border-radius: 30px;
                font-size: 15px;
                font-weight: 600;
                text-decoration: none;
                transition: var(--transition);
                cursor: pointer;
                margin: 10px;
            }

            .btn-primary {
                background-color: var(--primary);
                color: white;
                border: none;
            }

            .btn-primary:hover {
                background-color: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(42, 65, 232, 0.2);
            }

            @media (max-width: 480px) {
                .success-container {
                    padding: 25px 20px;
                }

                .success-title {
                    font-size: 22px;
                }
            }
        </style>
    </head>
    <body>
        <div class="success-container">
            <div class="success-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="success-title">Account Created Successfully!</h1>
            <p class="success-message">Your account has been successfully registered.</p>

            <a href="../pages/login.php" class="btn btn-primary">
                <i class="fas fa-sign-in-alt"></i> Proceed to Login
            </a>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "../pages/login.php";
            }, 5000);
        </script>
    </body>
    </html>';
} else {
    // Error response   
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="icon" href="./favicon.ico" type="image/x-icon">
        <style>
            :root {
                --primary: #000000;
                --primary-dark: #000000;
                --secondary: #000000;
                --text-dark: #2d3b45;
                --text-medium: #5d6974;
                --bg-white: #ffffff;
                --bg-light: #f7f9fc;
                --bg-accent: #EFF3FF;
                --border: #e5e8ed;
                --error: #e74c3c;
                --shadow-sm: 0 20px 80px rgba(0, 0, 0, 0.05);
                --shadow-md: 0 5px 15px rgba(0, 0, 0, 0.08);
                --transition: all 0.3s ease;
            }

            body {
                font-family: Inter, sans-serif;
                background-color: var(--bg-light);
                color: var(--text-dark);
                line-height: 1.6;
                margin: 0;
                padding: 0;
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
            }

            .success-container {
                background-color: var(--bg-white);
                border-radius: 12px;
                box-shadow: var(--shadow-md);
                padding: 40px;
                max-width: 500px;
                width: 70%;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .success-container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: linear-gradient(90deg, var(--primary), var(--secondary));
            }

            .success-icon {
                font-size: 60px;
                color: #4CAF50;
                margin-bottom: 20px;
            }

            .error-icon {
                color: var(--error);
            }

            .success-title {
                font-size: 26px;
                font-weight: 700;
                margin-bottom: 15px;
                color: var(--text-dark);
            }

            .success-message {
                color: var(--text-medium);
                font-size: 16px;
                margin-bottom: 25px;
            }

            .user-details {
                background-color: var(--bg-accent);
                border-radius: 8px;
                padding: 20px;
                margin: 20px 0;
                text-align: left;
            }

            .user-detail {
                margin-bottom: 10px;
            }

            .user-detail strong {
                color: var(--text-dark);
                font-weight: 600;
            }

            .btn {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 12px 25px;
                border-radius: 30px;
                font-size: 15px;
                font-weight: 600;
                text-decoration: none;
                transition: var(--transition);
                cursor: pointer;
                margin: 10px;
            }

            .btn-primary {
                background-color: var(--primary);
                color: white;
                border: none;
            }

            .btn-primary:hover {
                background-color: var(--primary-dark);
                transform: translateY(-2px);
                box-shadow: 0 8px 15px rgba(42, 65, 232, 0.2);
            }

            @media (max-width: 480px) {
                .success-container {
                    padding: 25px 20px;
                }

                .success-title {
                    font-size: 22px;
                }
            }
        </style>
    </head>
    <body>
        <div class="success-container">
            <div class="success-icon error-icon">
                <i class="fas fa-exclamation-circle"></i>
            </div>
            <h1 class="success-title">Error Creating Account</h1>
            <p class="success-message">There was a problem creating your account: ' . $stmt->error . '</p>
            <a href="../pages/register.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Try Again
            </a>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "../pages/register.php";
            }, 5000);
        </script>
    </body>
    </html>';
}
