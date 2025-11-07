<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Auth.php';
require_once __DIR__ . '/../includes/Utils.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }
    Utils::verifyCSRFToken($_POST['csrf_token'] ?? '');

    // Required fields
    if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['firstname']) || empty($_POST['lastname'])) {
        throw new Exception('Please fill out all required fields.');
    }

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $birthdate = !empty($_POST['birthdate']) ? trim($_POST['birthdate']) : null;
    $gender = !empty($_POST['gender']) ? trim($_POST['gender']) : null;
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $phone = !empty($_POST['phone_number']) ? trim($_POST['phone_number']) : null;

    // Handle file upload (store as /uploads/<filename>)
    $photoRel = null;
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $filename = Utils::uploadFile($_FILES['photo'], UPLOAD_DIR);
        $photoRel = '/uploads/' . $filename;
    }

    $auth = new Auth();
    $auth->register($username, $email, $password, [
        'firstname' => $firstname,
        'lastname'  => $lastname,
        'birthdate' => $birthdate,
        'gender'    => $gender,
        'phone_number' => $phone,
        'photo'     => $photoRel,
    ]);

    Utils::redirect('../pages/login.php', 'Account created successfully. Please log in.', 'success');
} catch (Throwable $e) {
    error_log('Register error: ' . $e->getMessage());
    Utils::redirect('../pages/register.php', 'Registration failed: ' . $e->getMessage(), 'error');
}
