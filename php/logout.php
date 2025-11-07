<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Auth.php';

if (isset($_GET['logout']) && $_GET['logout'] == 1) {
    $auth = new Auth();
    $auth->logout();
}

header('Location: ../pages/login.php');
exit;
