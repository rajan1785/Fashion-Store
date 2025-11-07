<?php
require 'config/db.php';
$sql = "SELECT * FROM orders";
$orders = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

$totalOrders = count($orders);
$pendingOrders = 0;
$processingOrders = 0;
$shippedOrders = 0;
$deliveredOrders = 0;
foreach($orders as $order){
    if($order['status'] == 'Pending'){
        $pendingOrders++;
    }elseif($order['status'] == 'Accepted'){
        $processingOrders++;
    }elseif($order['status'] == 'Shipped'){
        $shippedOrders++;
    }elseif($order['status'] == 'Delivered'){
        $deliveredOrders++;
    }
}

$filterStatus = ['pending', 'processing', 'shipped', 'delivered'];
$activeBtn = 'all';
if(isset($_GET['status'])){
    $filterStatus = [strtolower($_GET['status'])];
    $activeBtn = $filterStatus[0];
    if($filterStatus[0] == 'all'){
        $filterStatus = ['pending', 'processing', 'shipped', 'delivered'];
    }
}
?>


<div class="management-section">
    <h2 class="section-title">
        <span>Order Management</span>
        <span style="font-size: 16px; color: #666;">Total Orders: <span id="totalOrders"><?=$totalOrders?></span></span>
    </h2>
    
    <div class="stats-container">
        <div class="stat-card pending">
            <div class="stat-number" id="pendingCount"><?=$pendingOrders?></div>
            <div class="stat-label">Pending Orders</div>
        </div>
        <div class="stat-card processing">
            <div class="stat-number" id="processingCount"><?=$processingOrders?></div>
            <div class="stat-label">Processing</div>
        </div>
        <div class="stat-card shipped">
            <div class="stat-number" id="shippedCount"><?=$shippedOrders?></div>
            <div class="stat-label">Shipped</div>
        </div>
        <div class="stat-card delivered">
            <div class="stat-number" id="deliveredCount"><?=$deliveredOrders?></div>
            <div class="stat-label">Delivered</div>
        </div>
    </div>
    
    <div class="filter-bar">
        <button class="filter-btn <?=$activeBtn == 'all' ? 'active' : ''?>" onclick="window.location.href='?status=all'">All Orders</button>
        <button class="filter-btn <?=$activeBtn == 'pending' ? 'active' : ''?>" onclick="window.location.href='?status=pending'">Pending</button>
        <button class="filter-btn <?=$activeBtn == 'processing' ? 'active' : ''?>" onclick="window.location.href='?status=processing'">Processing</button>
        <button class="filter-btn <?=$activeBtn == 'shipped' ? 'active' : ''?>" onclick="window.location.href='?status=shipped'">Shipped</button>
        <button class="filter-btn <?=$activeBtn == 'delivered' ? 'active' : ''?>" onclick="window.location.href='?status=delivered'">Delivered</button>
        <button class="filter-btn <?=$activeBtn == 'cancelled' ? 'active' : ''?>" onclick="window.location.href='?status=cancelled'">Cancelled</button>
    </div>
    
    <div id="ordersTableContainer">
        <table class="orders-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Phone</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                <?php
                    $orderStatus = strtolower($order['status']);
                    if(!in_array($orderStatus, $filterStatus)){
                        continue;
                    }
                    $sql = "SELECT * FROM order_items WHERE order_id = {$order['id']}";
                    $orderItems = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);
                    $orderTotal = 0;
                    foreach ($orderItems as $item) {
                        $orderTotal += $item['price'] * $item['quantity'];
                    }
                ?>
                <tr>
                    <td><strong>ORD - <?=str_pad($order['id'], 3, '0', STR_PAD_LEFT)?></strong></td>
                    <td><?=date('d/m/Y, h:i A', strtotime($order['created_at']))?></td>
                    <td><?=$order['customer_name']?></td>
                    <td><?=$order['phone']?></td>
                    <td><strong>₹<?=number_format($orderTotal, 2, '.', ',')?></strong></td>
                    <td><span class="status-badge status-<?=strtolower($order['status'])?>"><?=$order['status']?></span></td>
                    <td>
                        <select class="action-select">
                            <option value="Pending" <?=($order['status'] == 'Pending') ? 'selected' : ''?>>Pending</option>
                            <option value="Processing" <?=($order['status'] == 'Processing') ? 'selected' : ''?>>Processing</option>
                            <option value="Shipped" <?=($order['status'] == 'Shipped') ? 'selected' : ''?>>Shipped</option>
                            <option value="Delivered" <?=($order['status'] == 'Delivered') ? 'selected' : ''?>>Delivered</option>
                            <option value="Cancelled" <?=($order['status'] == 'Cancelled') ? 'selected' : ''?>>Cancelled</option>
                        </select>
                        <button type="submit" class="update-btn" onclick="alert('Status updated!')">Update</button>
                        <button type="button" class="view-btn" onclick="viewOrder(<?=$order['id']?>)">View</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>