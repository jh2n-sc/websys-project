<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Database.php';

try {
    if (!isset($_GET['listing_id'])) {
        http_response_code(400);
        echo 'Missing listing_id';
        exit;
    }
    $id = (int)$_GET['listing_id'];
    $pdo = Database::getInstance()->getConnection();
    $stmt = $pdo->prepare('SELECT property_photo FROM listings WHERE listing_id = ?');
    $stmt->execute([$id]);
    $row = $stmt->fetch();
    if (!$row || empty($row['property_photo'])) {
        http_response_code(404);
        echo 'No image found';
        exit;
    }

    $blob = $row['property_photo'];
    // Try to detect mime
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo ? $finfo->buffer($blob) : 'image/jpeg';
    if (!preg_match('#^image/#', $mime)) {
        $mime = 'image/jpeg';
    }
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . strlen($blob));
    echo $blob;
} catch (Throwable $e) {
    error_log('image.php error: ' . $e->getMessage());
    http_response_code(500);
    echo 'Server error';
}
