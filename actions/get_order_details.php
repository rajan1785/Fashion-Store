<?php
require '../config/db.php';

// Return JSON responses
header('Content-Type: application/json');

if (isset($_GET['order_id'])) {
    $orderId = intval($_GET['order_id']);

    // Get order details using prepared statement
    $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
    $stmt->bind_param("i", $orderId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $order = $result->fetch_assoc();

        // Get order items
        $stmtItems = $conn->prepare("SELECT * FROM order_items WHERE order_id = ?");
        $stmtItems->bind_param("i", $orderId);
        $stmtItems->execute();
        $itemsResult = $stmtItems->get_result();

        $items = [];
        while ($item = $itemsResult->fetch_assoc()) {
            $items[] = $item;
        }

        echo json_encode([
            'success' => true,
            'order' => $order,
            'items' => $items
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Order not found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
