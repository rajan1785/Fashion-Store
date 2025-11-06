<?php
header('Content-Type: application/json');

// include your DB connection
include '../config/db.php'; // adjust path if needed

$data = json_decode(file_get_contents('php://input'), true);
$productId = intval($data['id']);
$available = intval($data['available']);

if (!$productId) {
    echo json_encode(['error' => 'Invalid product ID']);
    exit;
}

$sql = "UPDATE products SET avl_unit = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $available, $productId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update stock']);
}

$stmt->close();
$conn->close();
?>
