<?php
session_start();
$logged = 0;
// Check if 'username' exists in the session
if (isset($_SESSION['username'])) {
    // If not set, redirect to login page or show an error
    $logged = 1;
}

require 'config/db.php';

$sql = "SELECT * FROM products";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$products = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

// Close statement and connection
$stmt->close();
$conn->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Being Aesthetic</title>
    <link rel="stylesheet" href="assets/css/home.css">
    <style>
        .product-image img {
            width: 100%;        /* Make the image fill the container width */
            height: 200px;      /* Fix height for uniformity */
            object-fit: cover;  /* Scale and crop image to fit nicely */
            border-radius: 8px; /* Optional: rounded corners */
        }

    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="store-name">Aesthetic Store</div>
            <div class="store-tagline">Choose Ur Passion</div>
        </div>
    </header>

    <nav>
        <ul>
            <?php if($logged == 0):?>
                <li><a href="#">Home</a></li>
                <li><a href="tracking.php">Track Orders</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
            <?php elseif($logged == 1):?>
                <li><a href="#">Home</a></li>
                <li><a href="tracking.php">Track Orders</a></li>
                <li><a href="orders.php">Manage Orders</a></li>
                <li><a href="products.php">Products</a> </li>
                <li><a href="actions/logout.php">Logout</a></li>
            <?php endif;?>
        </ul>
    </nav>
    
    <div class="cart-container">
        <span class="cart-icon">🛒</span>
        <span class="cart-count">Cart: <span id="cartCount">0</span> items</span>
    </div>
    
    <div class="container">
        <div class="products-section">
            <h2 class="section-title">Our Products</h2>
            
            <div class="products-grid">
                <?php foreach($products as $product):?>
                <div class="product-card">
                    <div class="product-image">
                        <img src="assets/product-photo/<?=$product['photo'];?>">
                    </div>
                    <div class="product-name"><?=$product['name'];?></div>
                    <div class="product-description"><?=$product['description'];?></div>
                    <div class="product-price">₹<?=$product['price'];?></div>
                    <div class="product-quantity">Available: <?=$product['avl_unit'];?> units</div>
                    <button class="buy-button" onclick="addToCart('Cotton T-Shirt', 499)">Add to Cart</button>
                </div>
                <?php endforeach;?>
                <?php if (empty($products)): ?>
                    <h1 style="text-align: center; color: red; margin-top: 50px;">Products not Available</h1>
                <?php endif; ?>

            </div>

        </div>
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Fashion Store. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        function addToCart(productName, price) {
            let cart = [];
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                cart = JSON.parse(storedCart);
            }
            
            const existingProduct = cart.find(item => item.name === productName);
            if (existingProduct) {
                existingProduct.quantity += 1;
            } else {
                cart.push({
                    name: productName,
                    price: price,
                    quantity: 1
                });
            }
            
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartCount();
            alert(productName + ' added to cart!');
        }
        
        function updateCartCount() {
            let cart = [];
            const storedCart = localStorage.getItem('cart');
            if (storedCart) {
                cart = JSON.parse(storedCart);
            }
            
            let totalItems = 0;
            for (let i = 0; i < cart.length; i++) {
                totalItems += cart[i].quantity;
            }
            
            document.getElementById('cartCount').textContent = totalItems;
        }
        
        updateCartCount();
    </script>
</body>
</html>