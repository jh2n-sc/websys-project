<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Auth.php';
require_once __DIR__ . '/../includes/Utils.php';

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Not authenticated');
    }
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request');
    }

    Utils::verifyCSRFToken($_POST['csrf_token'] ?? '');

    $updates = [];
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname = trim($_POST['lastname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone_number'] ?? '');

    if ($firstname === '' || $lastname === '') {
        throw new Exception('First name and last name are required');
    }
    $updates['firstname'] = $firstname;
    $updates['lastname'] = $lastname;

    if ($email !== '') {
        if (!Utils::validateEmail($email)) {
            throw new Exception('Invalid email');
        }
        $updates['email'] = $email;
    }
    if ($phone !== '') {
        if (!preg_match('/^\d{11}$/', $phone)) {
            throw new Exception('Phone must be 11 digits');
        }
        $updates['phone_number'] = $phone;
    }

    // Optional: handle new profile photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $filename = Utils::uploadFile($_FILES['photo'], UPLOAD_DIR);
        $updates['photo'] = '/uploads/' . $filename;
    }

    if (empty($updates)) {
        Utils::redirect('../pages/profile_edit.php', 'Nothing to update', 'info');
    }

    $auth = new Auth();
    $auth->updateUserProfile((int)$_SESSION['user_id'], $updates);

    Utils::redirect('../pages/profile.php', 'Profile updated successfully', 'success');
} catch (Throwable $e) {
    error_log('Profile update error: ' . $e->getMessage());
    Utils::redirect('../pages/profile_edit.php', 'Update failed: ' . $e->getMessage(), 'error');
}
