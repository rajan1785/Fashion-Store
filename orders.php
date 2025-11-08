
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
    <title>Manage Orders - Elite Fashion Store</title>
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
            max-width: 1400px;
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
        
        .management-section {
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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-card.pending {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .stat-card.processing {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .stat-card.shipped {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        
        .stat-card.delivered {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }
        
        .stat-number {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 14px;
            opacity: 0.9;
        }
        
        .filter-bar {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }
        
        .filter-btn {
            background-color: #f0f0f0;
            border: 2px solid #ddd;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }
        
        .filter-btn.active {
            background-color: #27ae60;
            color: white;
            border-color: #27ae60;
        }
        
        .filter-btn:hover {
            background-color: #e0e0e0;
        }
        
        .filter-btn.active:hover {
            background-color: #229954;
        }
        
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .orders-table th {
            background-color: #333;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        
        .orders-table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        .orders-table tr:hover {
            background-color: #f9f9f9;
        }
        
        .status-badge {
            padding: 6px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
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
        
        .action-select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .update-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin-left: 10px;
        }
        
        .update-btn:hover {
            background-color: #229954;
        }
        
        .view-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
        }
        
        .view-btn:hover {
            background-color: #2980b9;
        }
        
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
        }

        .hide{
            display: none;
        }
        
        .modal-content {
            background-color: white;
            margin: 50px auto;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #27ae60;
        }
        
        .close-btn {
            font-size: 28px;
            font-weight: bold;
            color: #999;
            cursor: pointer;
        }
        
        .close-btn:hover {
            color: #333;
        }
        
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }

        /* Modal hardcoded content */
        .modal-body {
            padding: 15px 0;
        }

        .order-section {
            margin-bottom: 20px;
        }

        .order-section h4 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333;
        }

        .order-section p {
            margin-bottom: 6px;
            font-size: 14px;
            color: #555;
        }

        .order-items {
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 14px;
        }

        .order-total {
            display: flex;
            justify-content: space-between;
            padding: 15px 0;
            margin-top: 10px;
            border-top: 2px solid #27ae60;
            font-size: 18px;
            font-weight: bold;
            color: #27ae60;
        }

        /* Status badges for hardcoded orders */
        .status-badge {
            padding: 6px 15px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: bold;
            display: inline-block;
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

        
        @media (max-width: 768px) {
            .orders-table {
                font-size: 12px;
            }
            
            .orders-table th, .orders-table td {
                padding: 10px 5px;
            }
        }
    </style>
    
</head>
<body>
    <header>
        <div class="container">
            <div class="store-name">Elite Fashion Store</div>
            <div class="store-tagline">Admin Dashboard</div>
        </div>
    </header>
    
    <nav>
        <ul>
            <?php if($logged == 0):?>
                <li><a href="index.php">Home</a></li>
                <li><a href="tracking.php">Track Orders</a></li>
                <li><a href="login.php">Manage Orders</a></li>
            <?php elseif($logged == 1):?>
                <li><a href="index.php">Home</a></li>
                <li><a href="tracking.php">Track Orders</a></li>
                <li><a href="#">Manage Orders</a></li>
                <li><a href="products.php">Products</a> </li>
                <li><a href="actions/logout.php">Logout</a></li>
            <?php endif;?>
        </ul>
    </nav>
    
    <div class="container">
        <?php
            if($logged == 0){
                include 'components/login-section.php';
            }elseif($logged == 1){
                include 'components/manage-order-section.php';
            }
            ?>
    </div>
    
    <div id="orderModal" class="modal hide"> <!-- Set display:block to show modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h3>Order Details</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>

            <div id="modalBody" class="modal-body">

                <!-- Order Info -->
                <div class="order-section">
                    <p><strong>Order ID:</strong> #ORD12345</p>
                    <p><strong>Date:</strong> 2025-11-07</p>
                    <p><strong>Status:</strong> <span class="status-badge status-processing">Processing</span></p>
                </div>

                <!-- Customer Details -->
                <div class="order-section">
                    <h4>Customer Details:</h4>
                    <p><strong>Name:</strong> John Doe</p>
                    <p><strong>Phone:</strong> +91 9876543210</p>
                    <p><strong>Email:</strong> johndoe@example.com</p>
                    <p><strong>Address:</strong> 123, Main Street, Mumbai - 400001</p>
                    <p><strong>Notes:</strong> Please deliver between 9 AM - 5 PM.</p>
                </div>

                <!-- Order Items -->
                <div class="order-section order-items">
                    <h4>Order Items:</h4>
                    <div class="order-item">
                        <span>Blue T-Shirt × 2</span>
                        <span>₹1200</span>
                    </div>
                    <div class="order-item">
                        <span>Black Jeans × 1</span>
                        <span>₹1500</span>
                    </div>
                    <div class="order-item">
                        <span>Red Cap × 3</span>
                        <span>₹450</span>
                    </div>
                    <div class="order-total">
                        <span>Total:</span>
                        <span>₹3150</span>
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
    
    <script>
        

        function viewOrder(orderId) {
            fetch('actions/get_order_details.php?order_id=' + orderId)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const order = data.order;
                        const items = data.items;
                        showOrderDetails(order, items);
                    } else {
                        alert('Failed to load order details.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading order details.');
                });
        }

        function showOrderDetails(order, items){
            const modalBody = document.getElementById('orderModal');
            modalBody.classList.remove('hide');

            return;
        }
        
        function closeModal() {
            document.getElementById('orderModal').classList.add('hide');
        }
        
        window.onclick = function(event) {
            const modal = document.getElementById('orderModal');
            if (event.target === modal) {
                closeModal();
            }
        }
    </script>
</body>
</html>