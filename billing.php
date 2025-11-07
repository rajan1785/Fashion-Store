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
                    
                    <!-- <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email">
                    </div> -->
                    
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
                            <div class="item-name">No item added</div>
                            <div class="item-price">₹0.00 each</div>
                            <div class="item-quantity">
                                <button class="qty-btn">-</button>
                                <span class="qty-display">0</span>
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
                        <span id="delivery">₹50.00</span>
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
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Cart data:', cart);
            fetch('actions/fetch_products.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ cart: cart })
            })
            .then(res => res.json())
            .then(result => {
                console.log('Products fetched:', result);
                loadCartItems(result);
                // handleProducts(result);
            })
            .catch(err => console.error('Save error:', err));
        });
        
        function loadCartItems(data){
            console.log('Loading cart items with data:', data);
            const cartSection = document.querySelector('#cartItems');
            
            // Handle empty cart case
            if (!data || data.length === 0) {
                console.log('No products to display');
                cartSection.innerHTML = `
                    <div class="cart-item">
                        <div class="item-details">
                            <div class="item-name">No items in cart</div>
                            <div class="item-price">₹0.00 each</div>
                            <div class="item-quantity">
                                <button class="qty-btn">-</button>
                                <span class="qty-display">0</span>
                                <button class="qty-btn">+</button>
                            </div>
                        </div>
                        <button class="remove-btn">Remove</button>
                    </div>
                `;
                calculateCart();
                return;
            }
            
            let items = [];
            data.forEach(product => {
                const cartItem = cart.find(item => item.id === product.id);
                const quantity = cartItem ? cartItem.quantity : 1;
                console.log(`Product ${product.id}: cart quantity = ${quantity}`);

                items.push(`
                    <div class="cart-item" data-product-id="${product.id}">
                        <div class="item-details">
                            <div class="item-name">${product.name}</div>
                            <div class="item-price" data-price="${product.price}" data-available="${product.avl_unit}">₹${product.price} each</div>
                            <div class="item-quantity">
                                <button class="qty-btn" onclick="updateQuantity(this, -1)">-</button>
                                <span class="qty-display">${quantity}</span>
                                <button class="qty-btn" onclick="updateQuantity(this, 1)">+</button>
                            </div>
                        </div>
                        <button class="remove-btn" onclick="removeItem(this)">Remove</button>
                    </div>
                `);

            });
            console.log('Generated items:', items);
            cartSection.innerHTML = items.join('');
            calculateCart();
        }

        function updateCart() {
            // Save the updated cart to local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Fetch the product details again to reload the cart
            fetch('actions/fetch_products.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ cart: cart })
            })
            .then(res => res.json())
            .then(result => {
                loadCartItems(result);
            })
            .catch(err => console.error('Save error:', err));
        }

        function calculateCart(){
            const cartItems = document.querySelectorAll('.cart-item');
            let subtotal = 0.00;
            console.log(`Calculating cart total for ${cartItems.length} items`);
            
            cartItems.forEach(item => {
                const price = parseFloat(item.querySelector('.item-price').dataset.price);
                const quantity = parseInt(item.querySelector('.qty-display').textContent);
                console.log(`Item: price=${price}, quantity=${quantity}`);
                subtotal += price * quantity;
            });
            
            console.log(`Subtotal: ₹${subtotal.toFixed(2)}`);
            document.getElementById('subtotal').textContent = `₹${subtotal.toFixed(2)}`;
            document.getElementById('total').textContent = `₹${(subtotal + 50).toFixed(2)}`;
        }

        function removeItem(button) {
            const cartItem = button.closest('.cart-item');
            const productId = parseInt(cartItem.dataset.productId);

            // Remove the item from the cart array using the product ID
            cart = cart.filter(item => item.id !== productId);

            // Update local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Remove the item from the DOM
            cartItem.remove();

            // Recalculate the cart total
            calculateCart();
        }
        
        function updateQuantity(button, change) {
            const cartItem = button.closest('.cart-item');
            const quantityDisplay = cartItem.querySelector('.qty-display');
            const priceElement = cartItem.querySelector('.item-price');
            const productId = parseInt(cartItem.dataset.productId);
            
            let currentQuantity = parseInt(quantityDisplay.textContent);
            let newQuantity = currentQuantity + change;
            let availableStock = parseInt(priceElement.dataset.available);
            let unitPrice = parseFloat(priceElement.dataset.price);

            // Ensure quantity doesn't go below 1 or above available stock
            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > availableStock) newQuantity = availableStock;

            // Update the quantity display
            quantityDisplay.textContent = newQuantity;

            // Update the cart array with the new quantity
            const cartItemIndex = cart.findIndex(item => item.id === productId);
            if (cartItemIndex !== -1) {
                cart[cartItemIndex].quantity = newQuantity;
            }

            // Update local storage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Recalculate the cart total
            calculateCart();
        }

        // Function to handle order placement
        function placeOrder() {
            let finalOrderData = []
            const name = document.getElementById('name').value;
            const phone = document.getElementById('phone').value;
            const address = document.getElementById('address').value;
            const city = document.getElementById('city').value;
            const pincode = document.getElementById('pincode').value;
            const notes = document.getElementById('notes').value;
            if(notes === "") {
                notes = "none"
            }
            if (!name || !phone || !address || !city || !pincode || !notes) {
                console.log('name:', name, 'phone:', phone, 'address:', address, 'city:', city, 'pincode:', pincode, 'notes:', notes);
                alert('Please fill all required fields');
                return;
            }
            
            const cartItems = document.querySelectorAll('.cart-item');
            let cartData = [];
            cartItems.forEach(item => {
                product =[]
                const productName = item.querySelector('.item-name').textContent;
                const productPrice = item.querySelector('.item-price').dataset.price;
                const quantity = item.querySelector('.qty-display').textContent;
                if(!productName || !productPrice || !quantity) {
                    alert('invalid product');
                    return;
                }
                product.push(productName)
                product.push(productPrice)
                product.push(quantity)
                cartData.push(product)
            });

            finalOrderData.push(name)
            finalOrderData.push(phone)
            finalOrderData.push(address)
            finalOrderData.push(city)
            finalOrderData.push(pincode)
            finalOrderData.push(notes)
            finalOrderData.push(cartData)

            // Send data to backend via POST
            fetch('actions/place_order.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(finalOrderData)
            })
            .then(response => response.json())
            .then(data => {
                console.log("Server response:", data);
                if (data.success) {
                    alert('✅ Order placed successfully! You can track your order now.');
                    // Clear the cart
                    localStorage.removeItem('cart');
                    // Redirect to tracking or confirmation page
                    window.location.href = "tracking.php?order_id=" + data.order_id;
                } else {
                    alert('❌ Order failed: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error placing order:', error);
                alert('⚠️ There was an error placing your order. Please try again.', error);
            });
        }
        
    </script>      
</body>
</html>