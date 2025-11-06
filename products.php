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
    <title>Manage Products - Elite Fashion Store</title>
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
        
        .logout-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }
        
        .logout-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }
        
        .logout-btn:hover {
            background-color: #c0392b;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            font-size: 28px;
            color: #333;
        }
        
        .add-product-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 12px 30px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .add-product-btn:hover {
            background-color: #229954;
        }
        
        .products-table {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        thead {
            background-color: #333;
            color: white;
        }
        
        th {
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        
        td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        
        tbody tr:hover {
            background-color: #f9f9f9;
        }
        
        .product-emoji {
            font-size: 32px;
        }
        
        .product-photo {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
        }
        
        .action-buttons {
            display: flex;
            gap: 10px;
        }
        
        .edit-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .edit-btn:hover {
            background-color: #2980b9;
        }
        
        .delete-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        
        .delete-btn:hover {
            background-color: #c0392b;
        }
        
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            animation: fadeIn 0.3s;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 8px;
            height: 80%;
            overflow-y: scroll;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.3);
            animation: slideDown 0.3s;
        }
        
        @keyframes slideDown {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .modal-title {
            font-size: 24px;
            color: #333;
            font-weight: bold;
        }
        
        .close-btn {
            font-size: 28px;
            color: #999;
            cursor: pointer;
            border: none;
            background: none;
            transition: color 0.3s;
        }
        
        .close-btn:hover {
            color: #333;
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
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #27ae60;
        }
        
        .form-textarea {
            width: 100%;
            padding: 10px 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            resize: vertical;
            min-height: 80px;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #27ae60;
        }
        
        .modal-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            margin-top: 25px;
        }
        
        .cancel-btn {
            background-color: #95a5a6;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .cancel-btn:hover {
            background-color: #7f8c8d;
        }
        
        .save-btn {
            background-color: #27ae60;
            color: white;
            border: none;
            padding: 10px 24px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        
        .save-btn:hover {
            background-color: #229954;
        }
        
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        .product-row {
            transition: opacity 0.3s;
        }
        
        .product-row.deleting {
            opacity: 0.3;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="store-name">Elite Fashion Store</div>
            <div class="store-tagline">Choose Ur Passion</div>
        </div>
    </header>
    
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="tracking.php">Track Orders</a></li>
            <li><a href="orders.php">Manage Orders</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="actions/logout.php">Logout</a></li>
        </ul>
    </nav>
    
    <!-- <div class="logout-container">
        <button class="logout-btn" onclick="logout()">🚪 Logout</button>
    </div> -->
    
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Manage Products</h1>
            <button class="add-product-btn" onclick="openAddModal()">+ Add New Product</button>
        </div>
        
        <div class="products-table">
            <table>
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="productsTableBody">
                    <?php foreach($products as $product):?>
                    <tr class="product-row" id="row1">
                            <td><img src="assets/product-photo/<?=$product['photo'];?>" alt="NA" class="product-photo" id="photo1"></td>
                            <td><?=$product['name'];?></td>
                            <td><?=$product['description'];?></td>
                            <td>₹<?=$product['price'];?></td>
                            <td><?=$product['avl_unit'];?> units</td>
                            <td>
                                <div class="action-buttons">
                                    <button type="button" class="edit-btn" onclick="openEditModal(<?=$product['id']?>, '<?=$product['photo']?>', '<?=$product['name']?>','<?=$product['description']?>', <?=$product['price']?>, <?=$product['avl_unit']?>)">Edit</button>
                                    <button type="button" class="delete-btn" onclick="window.location.href='actions/delete_product.php?action=delete&id=<?=$product['id']?>'">Delete</button>
                                </div>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: red; font-weight: bold;">
                                Product Not Added
                            </td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Edit Product Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Edit Product</h2>
                <button class="close-btn" onclick="closeEditModal()">&times;</button>
            </div>
            <form method="POST" action="actions/edit_product.php" enctype="multipart/form-data" >
                <input type="hidden" id="productId" name="productId">
                <div class="form-group">
                    <label class="form-label" for="editPhoto">Product Photo</label>
                    <input type="file" class="form-input" id="editPhoto" name="photo" accept="image/*">
                    <small style="color: #666; font-size: 12px;">Upload new image (optional - leave empty to keep current)</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-input" id="editName" name="productName" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" id="editDescription" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" step="0.01" class="form-input" id="editPrice" name="price" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-input" id="editQty" name="qty" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="save-btn">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title">Add New Product</h2>
                <button class="close-btn" onclick="closeAddModal()">&times;</button>
            </div>
            <form method="POST" action="actions/add_product.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label">Product Photo</label>
                    <input type="file" class="form-input" id="addPhoto" name="photo" accept="image/*">
                    <small style="color: #666; font-size: 12px;">Upload a product image (optional)</small>
                </div>
                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-input" id="addName" name="productName" placeholder="Enter product name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-textarea" id="addDescription" name="description" placeholder="Enter product description" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Price (₹)</label>
                    <input type="number" class="form-input" id="addPrice" name="price" placeholder="Enter price" step="0.01" min="0" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-input" id="addQuantity" name="qty" placeholder="Enter quantity" required>
                </div>
                <div class="modal-actions">
                    <button type="button" class="cancel-btn" onclick="closeAddModal()">Cancel</button>
                    <button type="submit" class="save-btn">Add Product</button>
                </div>
            </form>
        </div>
    </div>
    
    
    <footer>
        <div class="container">
            <p>&copy; 2024 Elite Fashion Store. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        function openAddModal() {
            document.getElementById('addModal').style.display = 'block';
        }
        
        function closeAddModal() {
            document.getElementById('addModal').style.display = 'none';
            document.getElementById('addIcon').value = '';
            document.getElementById('addName').value = '';
            document.getElementById('addDescription').value = '';
            document.getElementById('addPrice').value = '';
            document.getElementById('addQuantity').value = '';
        }
        
        
        function openEditModal(id, photo, name, des, price, qty) {
            const editBox = document.getElementById('editModal');

            const productId = document.getElementById('productId');
            console.log(productId);
            const photoElement = document.getElementById('editPhoto');
            const nameElement = document.getElementById('editName');
            const desElement = document.getElementById('editDescription');
            const priceElement = document.getElementById('editPrice');
            const qtyElement = document.getElementById('editQty');
            console.log(qty);
            productId.value = id;
            
            nameElement.value = name;
            desElement.value = des;
            priceElement.value = price;
            qtyElement.value = qty;
            editBox.style.display = "block";
            // document.getElementById('editRowId').value = rowId;
            
            // const photoImg = document.querySelector('#' + rowId + ' .product-photo');
            // const emojiSpan = document.querySelector('#' + rowId + ' .product-emoji');
            
            // document.getElementById('editIcon').value = emojiSpan.textContent;
            // document.getElementById('editName').value = document.querySelector('#' + rowId + ' td:nth-child(2)').textContent;
            // document.getElementById('editDescription').value = document.querySelector('#' + rowId + ' td:nth-child(3)').textContent;
            // document.getElementById('editPrice').value = document.querySelector('#' + rowId + ' td:nth-child(4)').textContent.replace('₹', '');
            // document.getElementById('editQuantity').value = document.querySelector('#' + rowId + ' td:nth-child(5)').textContent.replace(' units', '');
            
            // document.getElementById('editModal').style.display = 'block';
        }
        
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
        
        
        
        // Handle delete action
        $message = "";
        $message_type = "";

        window.onclick = function(event) {
            if (event.target == document.getElementById('addModal')) {
                closeAddModal();
            }
            if (event.target == document.getElementById('editModal')) {
                closeEditModal();
            }
        }
        
        function logout() {
            if (confirm('Are you sure you want to logout?')) {
                alert('Logged out successfully!');
                window.location.href = 'login.php';
            }
        }
    </script>
</body>
</html>