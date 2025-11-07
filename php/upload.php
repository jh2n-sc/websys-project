<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/ErrorHandler.php';
require_once __DIR__ . '/../includes/Database.php';
require_once __DIR__ . '/../includes/Utils.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../pages/login.php');
    exit;
}

try {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request');
    }

    // CSRF protection
    Utils::verifyCSRFToken($_POST['csrf_token'] ?? '');

    $pdo = Database::getInstance()->getConnection();
    $seller_account_id = (int)$_SESSION['user_id'];

    $property_name = trim($_POST['name'] ?? '');
    $property_type = trim($_POST['property_type'] ?? '');
    $price = (float)($_POST['price'] ?? 0);
    $bed_no = trim($_POST['bed_no'] ?? '');
    $room_no = trim($_POST['room_no'] ?? '');
    $bath_no = trim($_POST['baths_no'] ?? '');
    $dim1 = (float)($_POST['size1M'] ?? 0);
    $finDimension = $dim1;
    $property_status = 'listed';
    $property_location = trim($_POST['location'] ?? '');
    $listingDate = date('Y-m-d');
    $property_details = trim($_POST['property_description'] ?? '');

    if ($property_name === '') {
        throw new Exception('Property name required');
    }

    // Read image as BLOB if present
    $photo = null;
    if (!empty($_FILES['propertyPhotos']) && $_FILES['propertyPhotos']['error'] === UPLOAD_ERR_OK) {
        $tmp = $_FILES['propertyPhotos']['tmp_name'];
        $photo = file_get_contents($tmp);
    }

    $pdo->beginTransaction();
    $stmt = $pdo->prepare("INSERT INTO listings (
        seller_account_id, property_name, property_details, price, property_type,
        property_dimension, property_description, property_status, property_location,
        listing_date, property_photo
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $seller_account_id, PDO::PARAM_INT);
    $stmt->bindParam(2, $property_name);
    $stmt->bindParam(3, $property_details);
    $stmt->bindParam(4, $price);
    $stmt->bindParam(5, $property_type);
    $stmt->bindParam(6, $finDimension);
    $stmt->bindParam(7, $property_details);
    $stmt->bindParam(8, $property_status);
    $stmt->bindParam(9, $property_location);
    $stmt->bindParam(10, $listingDate);
    $stmt->bindParam(11, $photo, PDO::PARAM_LOB);
    $stmt->execute();

    $ref_listing_id = (int)$pdo->lastInsertId();

    $stmt2 = $pdo->prepare("INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq)
                             VALUES (?, ?, ?, ?, ?)");
    $stmt2->execute([$ref_listing_id, $bed_no, $room_no, $bath_no, (int)$dim1]);

    $pdo->commit();
    header('Location: ../pages/profile.php');
    exit;
} catch (Throwable $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    error_log('upload.php error: ' . $e->getMessage());
    Utils::redirect('../pages/sell.php', 'Failed to submit listing: ' . $e->getMessage(), 'error');
}
