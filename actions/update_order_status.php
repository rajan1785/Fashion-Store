<?php
header('Content-Type: application/json');

// Check if required parameters are present
if (isset($_POST['order_id']) && isset($_POST['status'])) {
    require '../config/db.php';
    $orderId = intval($_POST['order_id']);
    $status = strtolower(trim($_POST['status']));
    
    
    // Update order status securely
    $sql = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $orderId);
    
    if ($stmt->execute()) {
        $conn->close();
        $stmt->close();
        header('Location: ../orders.php?success=status_updated');
        exit;
    } else {
        $conn->close();
        header('Location: ../orders.php?error=db_error');
        exit;
    }
    
} else {
    header('Location: ../orders.php?error=missing_params');
    exit;
}

?>
