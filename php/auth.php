<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Auth.php';
require_once __DIR__ . '/../includes/Utils.php';

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // CSRF check
    $token = $_POST['csrf_token'] ?? '';
    Utils::verifyCSRFToken($token);

    // Rate limiting
    $now = time();
    $attempts = $_SESSION['login_attempts']['count'] ?? 0;
    $firstAttemptAt = $_SESSION['login_attempts']['first_at'] ?? $now;
    $lockedUntil = $_SESSION['login_attempts']['locked_until'] ?? 0;
    if ($lockedUntil > $now) {
        $wait = $lockedUntil - $now;
        throw new Exception('Too many attempts. Try again in ' . $wait . ' seconds.');
    }
    // Reset window after 15 minutes
    if ($now - $firstAttemptAt > 15 * 60) {
        $_SESSION['login_attempts'] = ['count' => 0, 'first_at' => $now, 'locked_until' => 0];
        $attempts = 0;
        $firstAttemptAt = $now;
    }

    $identifier = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';
    if ($identifier === '' || $password === '') {
        throw new Exception('Please provide username and password');
    }

    $auth = new Auth();
    $auth->login($identifier, $password);

    // Reset attempts on success
    unset($_SESSION['login_attempts']);

    // Optional: provide a success flash message
    // Ensure session data is written before redirect
    session_write_close();
    Utils::redirect('../pages/profile.php', 'Logged in successfully.', 'success');
} catch (Throwable $e) {
    error_log('Auth error: ' . $e->getMessage());
    // increment attempts
    $now = time();
    if (!isset($_SESSION['login_attempts'])) {
        $_SESSION['login_attempts'] = ['count' => 0, 'first_at' => $now, 'locked_until' => 0];
    }
    $_SESSION['login_attempts']['count']++;
    if ($_SESSION['login_attempts']['count'] >= 5) {
        // lock for 10 minutes
        $_SESSION['login_attempts']['locked_until'] = $now + (10 * 60);
    }
    // Use flash messaging for consistency
    Utils::redirect('../pages/login.php', 'Login failed: ' . $e->getMessage(), 'error');
}

