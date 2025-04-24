<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    include_once '../php/db_conn.php';

    session_start();


    $fail = false;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $seller_account_id = $_SESSION['user_id'];
        $property_name = $_POST['name'] ?? '';
        $property_type = $_POST['property_type'] ?? ''; 
        $price = $_POST['price'] ?? '';
        $bed_no = $_POST['bed_no'] ?? '';
        $room_no =  $_POST['room_no'] ?? '';
        $bath_no = $_POST['baths_no'] ?? '';
        $dim1 = $_POST['size1M'] ?? 0;
        $dim2 = $_POST['size2M'] ?? 0;
        $finDimension = $dim1 . 'x' . $dim2;
        $property_status = 'listed';
        $property_location = $_POST['location'] ?? '';
        $listingDate = date("Y-m-d");
        
        $property_details = $_POST['description'] ?? 'No description provided';
    
        $photo = null;
        if (isset($_FILES['propertyPhotos']) && $_FILES['propertyPhotos']['error'] === UPLOAD_ERR_OK) {
            $tmpPhoto = $_FILES['propertyPhotos']['tmp_name'];
            $photo = file_get_contents($tmpPhoto);
        }
    
        $property_size = ((int)$dim1) * ((int)$dim2);
    
        
        $stmt = $conn->prepare("INSERT INTO listings (seller_account_id, property_name, property_details, price, property_type, property_dimension, property_description, property_status, property_location, listing_date, property_photo) 
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?); ");
        $stmt->bind_param("issdsssssss", $seller_account_id,
        $property_name, 
        $property_details,
        $price,
        $property_type,
        $finDimension,
        $property_details,
        $property_status,
        $property_location,
        $listingDate,
        $photo);
        if (!$stmt->execute()) {
            echo "fail";
            $fail = true;
        }

        $ref_listing_id = $conn->insert_id;

        $stmt = $conn->prepare("INSERT INTO property_more_details (ref_listing_id, bed_no, room_no, bath_no, size_msq) 
        VALUES (?, ?, ? ,? ,?);");
        $stmt->bind_param("issss", $ref_listing_id, $bed_no, $room_no, $bath_no, $property_size);
        if (!$stmt->execute()) {
            echo "fail";
            $fail = true;
        }

        if (!$fail) {
            header("Location: ../Profile/Profile.php");
            exit;
        }
    }
?>