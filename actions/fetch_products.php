<?php
header('Content-Type: application/json');

// --- 1. Connect to database ---
require '../config/db.php';


// --- 2. Get JSON data from frontend ---
$input = json_decode(file_get_contents('php://input'), true);
$cart = $input['cart'] ?? [];

// --- 3. Handle empty cart case ---
if (empty($cart)) {
    echo json_encode([]);
    exit;
}

// --- 4. Extract product IDs from cart objects ---
$productIds = [];
foreach ($cart as $item) {
    if (isset($item['id'])) {
        $productIds[] = $item['id'];
    }
}

// --- 5. Handle empty product IDs case ---
if (empty($productIds)) {
    echo json_encode([]);
    exit;
}

// --- 6. Prepare a safe SQL query ---
$placeholders = implode(',', array_fill(0, count($productIds), '?'));
$sql = "SELECT id, name, description, avl_unit, price, photo FROM products WHERE id IN ($placeholders)";
$stmt = $conn->prepare($sql);

// --- 7. Bind parameters dynamically ---
$types = str_repeat('i', count($productIds)); // all IDs are integers
$stmt->bind_param($types, ...$productIds);

// --- 8. Execute and fetch results ---
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}

// --- 9. Send back JSON ---
echo json_encode($products);

// --- 10. Clean up ---
$stmt->close();
$conn->close();
?>
