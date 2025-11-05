<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aesthetic Store</title>
    
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
            <li><a href="index.php">Home</a></li>
            <li><a href="billing.php">Cart & Billing</a></li>
            <li><a href="tracking.php">Track Orders</a></li>
            <li><a href="orders.php">Manage Orders</a></li>
            <li><a href="products.php">Add Product</a> </li>
            <li><a href="login.php">Login</a></li>
        </ul>
    </nav>
    
    <div class="container">
        
    </div>
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Fashion Store. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        function handleLogin(event) {
            event.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const rememberMe = document.getElementById('rememberMe').checked;
            
            const errorMessage = document.getElementById('errorMessage');
            const successMessage = document.getElementById('successMessage');
            
            errorMessage.style.display = 'none';
            successMessage.style.display = 'none';
            
            // Simple validation
            if (username.length < 3) {
                errorMessage.textContent = 'Username must be at least 3 characters long';
                errorMessage.style.display = 'block';
                return;
            }
            
            if (password.length < 6) {
                errorMessage.textContent = 'Password must be at least 6 characters long';
                errorMessage.style.display = 'block';
                return;
            }
            
            // Store login data in memory
            const userData = {
                username: username,
                loggedIn: true,
                loginTime: new Date().toISOString()
            };
            
            // Show success message
            successMessage.textContent = 'Login successful! Redirecting to home...';
            successMessage.style.display = 'block';
            
            // Simulate redirect after 1.5 seconds
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 1500);
        }
        
        // Check if user clicked forgot password
        document.querySelector('.forgot-password').addEventListener('click', (e) => {
            e.preventDefault();
            alert('Password reset functionality will be implemented soon!');
        });
        
        // Check if user clicked sign up
        document.querySelector('.signup-link a').addEventListener('click', (e) => {
            e.preventDefault();
            alert('Sign up page will be implemented soon!');
        });
    </script>
</body>
</html>