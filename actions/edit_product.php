<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../index.php?error=invalidRequest");
}

require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = intval($_POST['productId']);
    $name = trim($_POST['productName']);
    $description = trim($_POST['description']);
    $price = floatval($_POST['price']);
    $avl_unit = intval($_POST['qty']);
    
    // Fetch the old photo filename from DB
    $stmt = $conn->prepare("SELECT photo FROM products WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $stmt->bind_result($oldPhoto);
    $stmt->fetch();
    $stmt->close();
    
    $photoFileName = $oldPhoto; // Default to old photo
    
    // Handle new photo upload if provided
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

        $uploadDir = realpath(__DIR__ . '/../assets/product-photo');
        
        // Ensure upload directory exists and writable
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                die("Failed to create folder: $uploadDir");
            }
            @chown($uploadDir, 'daemon');
            @chgrp($uploadDir, 'daemon');
        }
        if (!is_writable($uploadDir)) {
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
        
        $check = getimagesize($tmpName);
        if ($check === false) {
            die("File is not an image.");
        }
        
        
        // Generate safe filename
        $dateTime = date('Ymd_His');
        $safeName = preg_replace("/[^a-zA-Z0-9_-]/", "_", $name);
        $photoFileName = $safeName . '_' . $dateTime . '.' . $extension;
        
        $uploadPath = $uploadDir . '/' . $photoFileName;
        
        if (!move_uploaded_file($tmpName, $uploadPath)) {
            $error = error_get_last();
            die("Failed to upload new image.<br>Error: " . ($error['message'] ?? 'Unknown'));
        }
        chmod($uploadPath, 0644);
        
        // Delete old photo if it exists
        if (!empty($oldPhoto)) {
            $oldPhotoPath = $uploadDir . '/' . $oldPhoto;
            if (file_exists($oldPhotoPath)) {
                @unlink($oldPhotoPath);
            }
        }
    }
    
    // Update the product record
    $stmt = $conn->prepare("UPDATE products SET name = ?, description = ?, price = ?, avl_unit = ?, photo = ? WHERE id = ?");
    $stmt->bind_param("ssdisi", $name, $description, $price, $avl_unit, $photoFileName, $product_id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../products.php?success=1&msg=productUpdated");
        exit;
    } else {
        die("Database update failed: " . $stmt->error);
    }
} else {
    header("Location: ../products.php?error=InvalidMethod");
    exit;
}
?>
