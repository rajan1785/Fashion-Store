
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
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
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
    
    <div id="orderModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Order Details</h3>
                <span class="close-btn" onclick="closeModal()">&times;</span>
            </div>
            <div id="modalBody"></div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Fashion Store. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        const dummyOrders = [
            {
                orderId: 'ORD1730885432123',
                date: '11/5/2024, 10:30 AM',
                name: 'Rahul Sharma',
                phone: '+91 98765 43210',
                email: 'rahul.sharma@email.com',
                address: '123 MG Road',
                city: 'Mumbai',
                pincode: '400001',
                notes: 'Please deliver between 2-5 PM',
                status: 'Pending',
                total: 3297,
                items: [
                    { name: 'Denim Jeans - Blue', price: 1299, quantity: 2 },
                    { name: 'Cotton Hoodie - Grey', price: 899, quantity: 1 }
                ]
            }
        ];
        
        function filterOrders(status) {
            const buttons = document.querySelectorAll('.filter-btn');
            buttons.forEach(btn => btn.classList.remove('active'));
            event.target.classList.add('active');
            
            const rows = document.querySelectorAll('.orders-table tbody tr');
            let visibleCount = 0;
            
            rows.forEach(row => {
                const statusBadge = row.querySelector('.status-badge').textContent;
                if (status === 'All' || statusBadge === status) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });
            
            if (visibleCount === 0) {
                document.getElementById('ordersTableContainer').innerHTML = '<div style="text-align: center; padding: 60px; color: #999; font-size: 18px;">No orders found</div>';
            }
        }
        
        <?php
        // require 'config/db.php';

        // $sql = "SELECT * FROM products";
        // $stmt = $conn->prepare($sql);
        // $result = $stmt->get_result();
        // $products = $result ? $result->fetch_all(MYSQLI_ASSOC): [];

        // $stmt->close();
        // $conn->close();
        ?>

        function viewOrder(index) {
            const order = dummyOrders[index];
            let html = '';
            
            html += '<div style="margin-bottom: 20px;">';
            html += '<p><strong>Order ID:</strong> ' + order.orderId + '</p>';
            html += '<p><strong>Date:</strong> ' + order.date + '</p>';
            html += '<p><strong>Status:</strong> <span class="status-badge status-' + order.status.toLowerCase() + '">' + order.status + '</span></p>';
            html += '</div>';
            
            html += '<div style="margin-bottom: 20px; padding: 15px; background-color: #f9f9f9; border-radius: 5px;">';
            html += '<h4 style="margin-bottom: 10px;">Customer Details:</h4>';
            html += '<p><strong>Name:</strong> ' + order.name + '</p>';
            html += '<p><strong>Phone:</strong> ' + order.phone + '</p>';
            html += '<p><strong>Email:</strong> ' + order.email + '</p>';
            html += '<p><strong>Address:</strong> ' + order.address + ', ' + order.city + ' - ' + order.pincode + '</p>';
            if (order.notes) {
                html += '<p><strong>Notes:</strong> ' + order.notes + '</p>';
            }
            html += '</div>';
            
            html += '<div style="margin-bottom: 20px;">';
            html += '<h4 style="margin-bottom: 10px;">Order Items:</h4>';
            order.items.forEach(item => {
                html += '<div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid #eee;">';
                html += '<span>' + item.name + ' × ' + item.quantity + '</span>';
                html += '<span>₹' + (item.price * item.quantity) + '</span>';
                html += '</div>';
            });
            html += '<div style="display: flex; justify-content: space-between; padding: 15px 0; margin-top: 10px; border-top: 2px solid #27ae60; font-size: 18px; font-weight: bold; color: #27ae60;">';
            html += '<span>Total:</span>';
            html += '<span>₹' + order.total + '</span>';
            html += '</div>';
            html += '</div>';
            
            document.getElementById('modalBody').innerHTML = html;
            document.getElementById('orderModal').style.display = 'block';
        }
        
        function closeModal() {
            document.getElementById('orderModal').style.display = 'none';
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