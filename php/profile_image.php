<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Database.php';

try {
    if (!isset($_GET['account_id'])) {
        http_response_code(400);
        echo 'Missing account_id';
        exit;
    }
    $id = (int)$_GET['account_id'];
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare('SELECT photo FROM accounts WHERE account_id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row || empty($row['photo'])) {
        http_response_code(404);
        echo 'image not found';
        exit;
    }
    $blob = $row['photo'];
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo ? $finfo->buffer($blob) : 'image/jpeg';
    if (!preg_match('#^image/#', $mime)) { $mime = 'image/jpeg'; }
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . strlen($blob));
    echo $blob;
} catch (Throwable $e) {
    error_log('profile_image.php error: ' . $e->getMessage());
    http_response_code(500);
    echo 'Server error';
}
