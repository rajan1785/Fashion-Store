<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['productName']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $avl_unit = intval($_POST['qty']);
    
    $photoFileName = null;
    
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        // Define upload directory
        $uploadDir = realpath(__DIR__ . '/../assets/product-photo');
        
        // Create directory with proper permissions if it doesn't exist
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                die("Failed to create folder: $uploadDir");
            }
            // Try to set ownership to daemon (XAMPP user on macOS)
            @chown($uploadDir, 'daemon');
            @chgrp($uploadDir, 'daemon');
        }
        
        // Make sure directory is writable
        if (!is_writable($uploadDir)) {
            // Try to make it writable
            chmod($uploadDir, 0777);
            if (!is_writable($uploadDir)) {
                die("Upload directory is not writable: $uploadDir");
            }
        }
        
        $tmpName = $_FILES['photo']['tmp_name'];
        $originalName = basename($_FILES['photo']['name']);
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($extension, $allowedExtensions)) {
            die("Invalid file type. Allowed: " . implode(', ', $allowedExtensions));
        }
        
        // Create a safe filename
        $dateTime = date('Ymd_His');
        $safeName = preg_replace("/[^a-zA-Z0-9_-]/", "_", $name);
        $photoFileName = $safeName . '_' . $dateTime . '.' . $extension;
        
        $uploadPath = $uploadDir . '/' . $photoFileName;
        
        // Check if file is actually an image
        $check = getimagesize($tmpName);
        if ($check === false) {
            die("File is not an image.");
        }
        
        // Check file size (max 5MB)
        if ($_FILES['photo']['size'] > 5000000) {
            die("File is too large. Maximum size is 5MB.");
        }
        
        if (!move_uploaded_file($tmpName, $uploadPath)) {
            $error = error_get_last();
            die("Failed to upload image.<br>Path: $uploadPath<br>Error: " . ($error['message'] ?? 'Unknown error') . "<br>Directory writable: " . (is_writable($uploadDir) ? 'Yes' : 'No'));
        }
        
        // Set file permissions after upload
        chmod($uploadPath, 0644);
    }
    
    // Prepare the INSERT query
    $stmt = $conn->prepare("INSERT INTO products (name, description, price, avl_unit, photo) VALUES (?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    
    $stmt->bind_param("ssdis", $name, $description, $price, $avl_unit, $photoFileName);
    
    if ($stmt->execute()) {
        header("Location: ../products.php?success=1&msg=productAdded");
        exit;
    } else {
        die("Database insert failed: " . $stmt->error);
    }
    
    $stmt->close();
    $conn->close();
} else {
    header("Location: ../products.php?error=InvalidMethod");
    exit;
}
?>