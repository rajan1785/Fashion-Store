<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: ../index.php?error=invalidRequest");
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    require '../config/db.php';
    $product_id = intval($_GET['id']);
    
    // First, get the photo filename to delete it
    $sql = "SELECT photo FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    
    // Delete the product
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    
    if ($stmt->execute()) {
        // Delete the photo file if it exists
        if (file_exists('../assets/product-photo/' . $product['photo'])) {
            $result = unlink('../assets/product-photo/' . $product['photo']);
            header("Location: ../products.php?success=1?msg=Deleted&photoDeleted=" . $result);
        }
        header("Location: ../products.php?success=1?msg=productDeleted&photoDeleted=0");
    } else {
        header("Location: ../products.php?error=failedToDeleteProduct");
    }
    $stmt->close();
}

?>