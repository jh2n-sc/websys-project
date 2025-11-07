<?php
// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/../logs/error.log');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);
ini_set('session.cookie_secure', isset($_SERVER['HTTPS']));
session_start();

// Application constants
define('APP_ROOT', dirname(__DIR__));
define('UPLOAD_DIR', APP_ROOT . '/uploads');

// Ensure upload directory exists
if (!file_exists(UPLOAD_DIR)) {
    mkdir(UPLOAD_DIR, 0755, true);
}

// Ensure logs directory exists
if (!file_exists(APP_ROOT . '/logs')) {
    mkdir(APP_ROOT . '/logs', 0755, true);
}
