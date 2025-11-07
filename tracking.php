<?php
session_start();
$logged = 0;
// Check if 'username' exists in the session
if (isset($_SESSION['username'])) {
    // If not set, redirect to login page or show an error
    $logged = 1;
}

if(isset($_GET['phone']) and $_GET['action'] == 'track') {
    $phone = intval($_GET['phone']);
    require 'config/db.php';
    $sql = "SELECT * FROM orders WHERE phone = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $phone);
    $stmt->execute();
    $result = $stmt->get_result();

    $orders = [];
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $orders[] = $row;
        }
    } else {
        header("Location: tracking.php?phone=$phone&msg=no_order");
    }
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Orders - Elite Fashion Store</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            line-height: 1.6;
        }
        
        header {
            background-color: #333;
            color: white;
            padding: 20px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .store-name {
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
        
        .store-tagline {
            text-align: center;
            font-size: 16px;
            color: #ddd;
        }
        
        nav {
            background-color: #444;
            padding: 15px 0;
            margin-bottom: 30px;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 30px;
        }
        
        nav a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        
        nav a:hover {
            background-color: #555;
        }
        
        .tracking-section {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 28px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 10px;
        }
        
        .search-box {
            display: flex;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .search-input {
            flex: 1;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .search-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .search-btn:hover {
            background-color: #229954;
        }
        
        .order-card {
            background-color: #f9f9f9;
            padding: 25px;
            border-radius: 8px;
            border-left: 5px solid #27ae60;
            margin-bottom: 20px;
        }
        
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .order-id {
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }
        
        .order-date {
            color: #666;
            font-size: 14px;
        }
        
        .status-badge {
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            font-size: 14px;
        }
        
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .status-processing {
            background-color: #cce5ff;
            color: #004085;
        }
        
        .status-shipped {
            background-color: #d1ecf1;
            color: #0c5460;
        }
        
        .status-delivered {
            background-color: #d4edda;
            color: #155724;
        }
        
        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .order-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .detail-item {
            padding: 10px;
            background-color: white;
            border-radius: 5px;
        }
        
        .detail-label {
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
        }
        
        .detail-value {
            color: #333;
        }
        
        .order-items {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        
        .order-items-title {
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }
        
        .item-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            color: #666;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            padding-top: 15px;
            margin-top: 15px;
            border-top: 2px solid #27ae60;
            font-size: 20px;
            font-weight: bold;
            color: #27ae60;
        }
        
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        @media (max-width: 768px) {
            .order-details {
                grid-template-columns: 1fr;
            }
            
            .search-box {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="store-name">Elite Fashion Store</div>
            <div class="store-tagline">Your Style, Our Passion</div>
        </div>
    </header>
    
    <nav>
        <ul>
            <?php if($logged == 0):?>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Track Orders</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
            <?php elseif($logged == 1):?>
                <li><a href="index.php">Home</a></li>
                <li><a href="#">Track Orders</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
                <li><a href="products.php">Products</a> </li>
                <li><a href="actions/logout.php">Logout</a></li>
            <?php endif;?>
        </ul>
    </nav>
    
    <div class="container">
        <div class="tracking-section">
            <h2 class="section-title">Track Your Orders</h2>
            <form method="GET" action="tracking.php">
            <div class="search-box">
                <input type="hidden" name="action" value="track">
                <input type="number" class="search-input" id="phoneSearch" name="phone" value="<?php echo isset($_GET['phone']) && $_GET['action'] == 'track' ? $_GET['phone'] : ''; ?>" placeholder="Enter your phone number">
                <button class="search-btn" type="submit">Search Orders</button>
            </div>
            
            <div id="ordersContainer">
                <?php if($_GET['msg'] == 'no_order'):?>
                    <h2 style="color: red; text-align: center;">No orders found for <?=$_GET['phone'];?></h2>
                <?php endif;?>
                <!-- Order 1 - Shipped -->
                <?php foreach($orders as $order):?>
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order ID: <?= $order['id'];?></div>
                            <div class="order-date"><?= date('h:i A j M, Y', strtotime($order['created_at'])); ?></div>
                        </div>
                        <div class="status-badge status-shipped"><?php echo $order['status'];?></div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Customer Name</div>
                            <div class="detail-value"><?=$order['customer_name'];?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value"><?=$order['phone'];?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Delivery Address</div>
                            <div class="detail-value"><?=$order['address'];?></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value"><?=$order['notes'];?></div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        <?php
                        $sql = "SELECT * FROM order_items WHERE order_id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param('s', $order['id']);
                        $stmt->execute();
                        $order_items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        $total_amount = 50.00;
                        ?>
                        <?php foreach($order_items as $item):?>
                        <?php $pAmount = ($item['price'] * $item['quantity']);?>
                        <div class="item-row">
                            <span><?=$item['name'];?>  × <?=$item['quantity'];?></span>
                            <span>₹<?=$pAmount;?></span>
                        </div>
                        <?php $total_amount = $total_amount + $pAmount;?>
                        <?php endforeach;?>
                        <div class="total-row">
                            <span>Total Amount:</span>
                            <span>₹<?=$total_amount?></span>
                        </div>
                        <small>₹50 Delivery Charge Included</small>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Fashion Store. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>