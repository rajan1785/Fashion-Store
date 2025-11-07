<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json");

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");


require '../config/db.php'; // assumes $conn = new mysqli(...)

// --- Get raw POST data ---
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// --- Basic validation ---
if (!$data || count($data) < 7) {
    echo json_encode(["success" => false, "message" => "Invalid data received"]);
    exit;
}

// --- Extract data safely ---
$name    = trim($data[0]);
$phone   = trim($data[1]);
$address = trim($data[2]);
$city    = trim($data[3]);
$pincode = trim($data[4]);
$notes   = trim($data[5]);
$items   = $data[6]; // Array of [product_name, price, qty]

if (empty($items) || !is_array($items)) {
    echo json_encode(["success" => false, "message" => "No items in order"]);
    exit;
}

// --- Insert into orders table ---
$stmt_order = $conn->prepare("
    INSERT INTO orders (customer_name, phone, address, city, pincode, notes)
    VALUES (?, ?, ?, ?, ?, ?)
");
$stmt_order->bind_param("ssssss", $name, $phone, $address, $city, $pincode, $notes);

if ($stmt_order->execute()) {
    $order_id = $conn->insert_id;

    // Prepare statement for order_items
    $stmt_item = $conn->prepare("
        INSERT INTO order_items (order_id, name, price, quantity)
        VALUES (?, ?, ?, ?)
    ");

    foreach ($items as $item) {
        // Validate item structure
        if (count($item) < 3) continue;

        $product_name = trim($item[0]);
        $price = round(floatval($item[1]), 2); // round to 2 decimal points
        $qty = intval($item[2]);


        $stmt_item->bind_param("isdi", $order_id, $product_name, $price, $qty);
        $stmt_item->execute();
    }

    echo json_encode([
        "success" => true,
        "message" => "Order placed successfully",
        "order_id" => $order_id
    ]);

} else {
    echo json_encode(["success" => false, "message" => "Failed to save order"]);
}

$conn->close();
?>
