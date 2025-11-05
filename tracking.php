<?php
session_start();
$logged = 0;
// Check if 'username' exists in the session
if (isset($_SESSION['username'])) {
    // If not set, redirect to login page or show an error
    $logged = 1;
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
            
            <div class="search-box">
                <input type="text" class="search-input" id="phoneSearch" placeholder="Enter your phone number">
                <button class="search-btn" onclick="alert('Search functionality - Enter phone number to filter orders')">Search Orders</button>
            </div>
            
            <div id="ordersContainer">
                <!-- Order 1 - Shipped -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order ID: ORD1730878954321</div>
                            <div class="order-date">11/4/2024, 6:45 PM</div>
                        </div>
                        <div class="status-badge status-shipped">Shipped</div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Customer Name</div>
                            <div class="detail-value">Amit Patel</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value">+91 76543 21098</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Delivery Address</div>
                            <div class="detail-value">789 Ring Road, Ahmedabad - 380001</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">amit.patel@email.com</div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        <div class="item-row">
                            <span>Denim Jeans - Blue × 1</span>
                            <span>₹1,299</span>
                        </div>
                        <div class="item-row">
                            <span>Summer Dress × 1</span>
                            <span>₹1,349</span>
                        </div>
                        <div class="total-row">
                            <span>Total Amount:</span>
                            <span>₹2,698</span>
                        </div>
                    </div>
                </div>

                <!-- Order 2 - Processing -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order ID: ORD1730882156789</div>
                            <div class="order-date">11/5/2024, 9:15 AM</div>
                        </div>
                        <div class="status-badge status-processing">Processing</div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Customer Name</div>
                            <div class="detail-value">Priya Singh</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value">+91 87654 32109</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Delivery Address</div>
                            <div class="detail-value">456 Park Street, Delhi - 110001</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">priya.singh@email.com</div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        <div class="item-row">
                            <span>Casual Sneakers × 2</span>
                            <span>₹3,998</span>
                        </div>
                        <div class="item-row">
                            <span>Classic T-Shirt × 1</span>
                            <span>₹499</span>
                        </div>
                        <div class="total-row">
                            <span>Total Amount:</span>
                            <span>₹4,548</span>
                        </div>
                    </div>
                </div>

                <!-- Order 3 - Delivered -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order ID: ORD1730875123456</div>
                            <div class="order-date">11/4/2024, 3:20 PM</div>
                        </div>
                        <div class="status-badge status-delivered">Delivered</div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Customer Name</div>
                            <div class="detail-value">Sneha Reddy</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value">+91 65432 10987</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Delivery Address</div>
                            <div class="detail-value">321 Beach Road, Chennai - 600001</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">sneha.reddy@email.com</div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        <div class="item-row">
                            <span>Casual Sneakers × 2</span>
                            <span>₹3,998</span>
                        </div>
                        <div class="item-row">
                            <span>Classic T-Shirt × 3</span>
                            <span>₹1,497</span>
                        </div>
                        <div class="total-row">
                            <span>Total Amount:</span>
                            <span>₹5,497</span>
                        </div>
                    </div>
                </div>

                <!-- Order 4 - Pending -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order ID: ORD1730885432123</div>
                            <div class="order-date">11/5/2024, 10:30 AM</div>
                        </div>
                        <div class="status-badge status-pending">Pending</div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Customer Name</div>
                            <div class="detail-value">Rahul Sharma</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value">+91 98765 43210</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Delivery Address</div>
                            <div class="detail-value">123 MG Road, Mumbai - 400001</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">rahul.sharma@email.com</div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        <div class="item-row">
                            <span>Denim Jeans - Blue × 2</span>
                            <span>₹2,598</span>
                        </div>
                        <div class="item-row">
                            <span>Cotton Hoodie - Grey × 1</span>
                            <span>₹899</span>
                        </div>
                        <div class="total-row">
                            <span>Total Amount:</span>
                            <span>₹3,297</span>
                        </div>
                    </div>
                </div>

                <!-- Order 5 - Cancelled -->
                <div class="order-card">
                    <div class="order-header">
                        <div>
                            <div class="order-id">Order ID: ORD1730870123456</div>
                            <div class="order-date">11/3/2024, 5:30 PM</div>
                        </div>
                        <div class="status-badge status-cancelled">Cancelled</div>
                    </div>
                    
                    <div class="order-details">
                        <div class="detail-item">
                            <div class="detail-label">Customer Name</div>
                            <div class="detail-value">Neha Kapoor</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Phone</div>
                            <div class="detail-value">+91 55555 44444</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Delivery Address</div>
                            <div class="detail-value">555 Green Avenue, Kolkata - 700001</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Email</div>
                            <div class="detail-value">neha.kapoor@email.com</div>
                        </div>
                    </div>
                    
                    <div class="order-items">
                        <div class="order-items-title">Order Items:</div>
                        <div class="item-row">
                            <span>Summer Dress × 2</span>
                            <span>₹2,698</span>
                        </div>
                        <div class="item-row">
                            <span>Classic T-Shirt × 1</span>
                            <span>₹499</span>
                        </div>
                        <div class="total-row">
                            <span>Total Amount:</span>
                            <span>₹3,197</span>
                        </div>
                    </div>
                </div>
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