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

.login-section {
    padding: 30px 0;
    min-height: calc(100vh - 300px);
    display: flex;
    justify-content: center;
    align-items: center;
}

.login-box {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 40px;
    width: 100%;
    max-width: 450px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.login-title {
    font-size: 28px;
    font-weight: bold;
    text-align: center;
    color: #333;
    margin-bottom: 10px;
}

.login-subtitle {
    text-align: center;
    color: #666;
    margin-bottom: 30px;
    font-size: 14px;
}

.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    font-size: 14px;
    font-weight: bold;
    color: #333;
    margin-bottom: 8px;
}

.form-input {
    width: 100%;
    padding: 12px 15px;
    font-size: 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: border-color 0.3s;
}

.form-input:focus {
    outline: none;
    border-color: #27ae60;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    font-size: 14px;
}

.remember-me {
    display: flex;
    align-items: center;
    gap: 5px;
    color: #666;
}

.forgot-password {
    color: #27ae60;
    text-decoration: none;
    transition: color 0.3s;
}

.forgot-password:hover {
    color: #229954;
    text-decoration: underline;
}

.login-button {
    width: 100%;
    background-color: #27ae60;
    color: white;
    border: none;
    padding: 12px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.login-button:hover {
    background-color: #229954;
}

.divider {
    text-align: center;
    margin: 25px 0;
    color: #999;
    font-size: 14px;
    position: relative;
}

.divider::before,
.divider::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 40%;
    height: 1px;
    background-color: #ddd;
}

.divider::before {
    left: 0;
}

.divider::after {
    right: 0;
}

.signup-link {
    text-align: center;
    color: #666;
    font-size: 14px;
}

.signup-link a {
    color: #27ae60;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s;
}

.signup-link a:hover {
    color: #229954;
    text-decoration: underline;
}

.error-message {
    background-color: #fee;
    color: #c33;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
    font-size: 14px;
    display: none;
}

.success-message {
    background-color: #efe;
    color: #3c3;
    padding: 10px;
    border-radius: 4px;
    margin-bottom: 20px;
    font-size: 14px;
    display: none;
}

footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 20px 0;
    margin-top: 50px;
}
</style>
<div class="login-section">
    <div class="login-box">
        <h1 class="login-title">Welcome Back!</h1>
        <p class="login-subtitle">Login to continue shopping</p>
        
        <div class="error-message" id="errorMessage"></div>
        <div class="success-message" id="successMessage"></div>
        
        <form id="loginForm" method="POST" action="actions/login.php">
            <div class="form-group">
                <label class="form-label" for="username">Username</label>
                <input 
                    type="text" 
                    id="username"
                    name="username"
                    class="form-input" 
                    placeholder="Enter your username"
                    required
                >
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    class="form-input" 
                    placeholder="Enter your password"
                    required
                >
            </div>
            
            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" id="rememberMe">
                    Remember me
                </label>
                <a href="#" class="forgot-password">Forgot Password?</a>
            </div>
            
            <button type="submit" class="login-button">Login</button>
        </form>
        
        <div class="divider">OR</div>
        
        <div class="signup-link">
            Don't have an account? <a href="#">Sign Up</a>
        </div>
    </div>
</div>

