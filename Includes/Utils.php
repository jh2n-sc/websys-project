<?php
class Utils {
    // Generate CSRF token
    public static function generateCSRFToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }
    
    // Verify CSRF token
    public static function verifyCSRFToken($token) {
        if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
            throw new Exception("Invalid CSRF token");
        }
        return true;
    }
    
    // Sanitize input
    public static function sanitizeInput($data) {
        if (is_array($data)) {
            return array_map([self::class, 'sanitizeInput'], $data);
        }
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }
    
    // Redirect with message
    public static function redirect($location, $message = null, $type = 'success') {
        if ($message) {
            $_SESSION['flash_message'] = $message;
            $_SESSION['flash_type'] = $type;
        }
        header("Location: $location");
        exit();
    }
    
    // Get flash message
    public static function getFlashMessage() {
        if (isset($_SESSION['flash_message'])) {
            $message = $_SESSION['flash_message'];
            $type = $_SESSION['flash_type'] ?? 'info';
            unset($_SESSION['flash_message'], $_SESSION['flash_type']);
            return ['message' => $message, 'type' => $type];
        }
        return null;
    }
    
    // Validate email
    public static function validateEmail($email) {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
    
    // Secure file upload
    public static function uploadFile($file, $targetDir, $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']) {
        $targetFile = $targetDir . '/' . basename($file['name']);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        
        // Check if file is an actual image
        $check = getimagesize($file['tmp_name']);
        if ($check === false) {
            throw new Exception("File is not an image.");
        }
        
        // Check file size (5MB max)
        if ($file['size'] > 5000000) {
            throw new Exception("Sorry, your file is too large. Maximum size is 5MB.");
        }
        
        // Allow certain file formats
        if (!in_array($check['mime'], $allowedTypes)) {
            throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        }
        
        // Generate unique filename
        $newFilename = uniqid() . '.' . $imageFileType;
        $targetFile = $targetDir . '/' . $newFilename;
        
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            return $newFilename;
        } else {
            throw new Exception("Sorry, there was an error uploading your file.");
        }
    }
}
