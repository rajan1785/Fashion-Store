<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing - Elite Fashion Store</title>
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
        
        .billing-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }
        
        .section {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .section-title {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            border-bottom: 2px solid #27ae60;
            padding-bottom: 10px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        textarea {
            resize: vertical;
            min-height: 80px;
        }
        
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .cart-item:last-child {
            border-bottom: none;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        
        .item-price {
            color: #27ae60;
            font-size: 18px;
        }
        
        .item-quantity {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 10px 0;
        }
        
        .qty-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            width: 30px;
            height: 30px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }
        
        .qty-btn:hover {
            background-color: #229954;
        }
        
        .qty-display {
            font-size: 16px;
            font-weight: bold;
            min-width: 30px;
            text-align: center;
        }
        
        .remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .remove-btn:hover {
            background-color: #c0392b;
        }
        
        .total-section {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 2px solid #27ae60;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 18px;
        }
        
        .total-amount {
            font-size: 24px;
            font-weight: bold;
            color: #27ae60;
        }
        
        .place-order-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 20px;
        }
        
        .place-order-btn:hover {
            background-color: #229954;
        }
        
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        @media (max-width: 768px) {
            .billing-container {
                grid-template-columns: 1fr;
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
        <div class="billing-container">
            <div class="section">
                <h2 class="section-title">Delivery Details</h2>
                <form id="orderForm">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Phone Number *</label>
                        <input type="tel" id="phone" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email">
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Delivery Address *</label>
                        <textarea id="address" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="city">City *</label>
                        <input type="text" id="city" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="pincode">Pincode *</label>
                        <input type="text" id="pincode" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="notes">Additional Notes</label>
                        <textarea id="notes"></textarea>
                    </div>
                </form>
            </div>
            
            <div class="section">
                <h2 class="section-title">Order Summary</h2>
                <div id="cartItems">
                    <!-- Static Cart Items -->
                    <div class="cart-item">
                        <div class="item-details">
                            <div class="item-name">Classic Cotton T-Shirt</div>
                            <div class="item-price">₹499 each</div>
                            <div class="item-quantity">
                                <button class="qty-btn">-</button>
                                <span class="qty-display">2</span>
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <button class="remove-btn">Remove</button>
                    </div>
                    
                    <div class="cart-item">
                        <div class="item-details">
                            <div class="item-name">Denim Jeans - Blue</div>
                            <div class="item-price">₹1,299 each</div>
                            <div class="item-quantity">
                                <button class="qty-btn">-</button>
                                <span class="qty-display">1</span>
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <button class="remove-btn">Remove</button>
                    </div>
                    
                    <div class="cart-item">
                        <div class="item-details">
                            <div class="item-name">Casual Sneakers</div>
                            <div class="item-price">₹1,999 each</div>
                            <div class="item-quantity">
                                <button class="qty-btn">-</button>
                                <span class="qty-display">1</span>
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <button class="remove-btn">Remove</button>
                    </div>
                    
                    <div class="cart-item">
                        <div class="item-details">
                            <div class="item-name">Cotton Hoodie - Grey</div>
                            <div class="item-price">₹899 each</div>
                            <div class="item-quantity">
                                <button class="qty-btn">-</button>
                                <span class="qty-display">1</span>
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <button class="remove-btn">Remove</button>
                    </div>
                </div>
                
                <div class="total-section">
                    <div class="total-row">
                        <span>Subtotal:</span>
                        <span id="subtotal">₹4,595</span>
                    </div>
                    <div class="total-row">
                        <span>Delivery Charges:</span>
                        <span id="delivery">₹50</span>
                    </div>
                    <div class="total-row">
                        <span class="total-amount">Total:</span>
                        <span class="total-amount" id="total">₹4,645</span>
                    </div>
                </div>
                
                <button class="place-order-btn" onclick="placeOrder()">Place Order</button>
            </div>
        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Fashion Store. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        function placeOrder() {
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const city = document.getElementById('city').value;
            const pincode = document.getElementById('pincode').value;
            
            if (!name || !phone || !address || !city || !pincode) {
                alert('Please fill all required fields');
                return;
            }
            
            alert('Order placed successfully! Thank you for your order.');
        }
    </script>
</body>
</html>