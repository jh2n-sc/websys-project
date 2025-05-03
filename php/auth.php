<?php
include '../php/db_conn.php';

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

        header("Location: ../pages/profile.php");
        exit();
    } else {
        // Incorrect password notification
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login Error</title>
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

                .error-container {
                    background-color: var(--bg-white);
                    border-radius: 12px;
                    box-shadow: var(--shadow-md);
                    padding: 40px;
                    max-width: 500px;
                    width: 20%;
                    text-align: center;
                    position: relative;
                    overflow: hidden;
                }

                .error-container::before {
                    content: "";
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 5px;
                    background: var(--error);
                }

                .error-icon {
                    font-size: 60px;
                    color: var(--error);
                    margin-bottom: 20px;
                }

                .error-title {
                    font-size: 26px;
                    font-weight: 700;
                    margin-bottom: 15px;
                    color: var(--text-dark);
                }

                .error-message {
                    color: var(--text-medium);
                    font-size: 16px;
                    margin-bottom: 25px;
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
                    .error-container {
                        padding: 25px 20px;
                    }

                    .error-title {
                        font-size: 22px;
                    }
                }
            </style>
        </head>
        <body>
            <div class="error-container">
                <div class="error-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h1 class="error-title">Login Failed</h1>
                <p class="error-message">Incorrect password. Please try again.</p>
                <a href="../pages/login.php" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Login
                </a>
            </div>
            <script>
                setTimeout(function() {
                    window.location.href = "../pages/login.php";
                }, 3000); // Redirect after 3 seconds
            </script>
        </body>
        </html>';
        exit();
    }
} else {
    // User not found notification
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Error</title>
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
            .error-container {
                background-color: var(--bg-white);
                border-radius: 12px;
                box-shadow: var(--shadow-md);
                padding: 40px;
                max-width: 500px;
                width: 20%;
                text-align: center;
                position: relative;
                overflow: hidden;
            }

            .error-container::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 5px;
                background: var(--error);
            }

            .error-icon {
                font-size: 60px;
                color: var(--error);
                margin-bottom: 20px;
            }

            .error-title {
                font-size: 26px;
                font-weight: 700;
                margin-bottom: 15px;
                color: var(--text-dark);
            }

            .error-message {
                color: var(--text-medium);
                font-size: 16px;
                margin-bottom: 25px;
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
                .error-container {
                    padding: 25px 20px;
                }

                .error-title {
                    font-size: 22px;
                }
            }
        </style>
    </head>
    <body>
        <div class="error-container">
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h1 class="error-title">Login Failed</h1>
            <p class="error-message">User not found. Please check your username.</p>
            <a href="../pages/login.php" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back to Login
            </a>
        </div>
        <script>
            setTimeout(function() {
                window.location.href = "../pages/login.php";
            }, 3000); // Redirect after 3 seconds
        </script>
    </body>
    </html>';
    exit();
}

$stmt->close();
$conn->close();
