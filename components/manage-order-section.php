<div class="management-section">
            <h2 class="section-title">
                <span>Order Management</span>
                <span style="font-size: 16px; color: #666;">Total Orders: <span id="totalOrders">8</span></span>
            </h2>
            
            <div class="stats-container">
                <div class="stat-card pending">
                    <div class="stat-number" id="pendingCount">2</div>
                    <div class="stat-label">Pending Orders</div>
                </div>
                <div class="stat-card processing">
                    <div class="stat-number" id="processingCount">2</div>
                    <div class="stat-label">Processing</div>
                </div>
                <div class="stat-card shipped">
                    <div class="stat-number" id="shippedCount">2</div>
                    <div class="stat-label">Shipped</div>
                </div>
                <div class="stat-card delivered">
                    <div class="stat-number" id="deliveredCount">2</div>
                    <div class="stat-label">Delivered</div>
                </div>
            </div>
            
            <div class="filter-bar">
                <button class="filter-btn active" onclick="filterOrders('All')">All Orders</button>
                <button class="filter-btn" onclick="filterOrders('Pending')">Pending</button>
                <button class="filter-btn" onclick="filterOrders('Processing')">Processing</button>
                <button class="filter-btn" onclick="filterOrders('Shipped')">Shipped</button>
                <button class="filter-btn" onclick="filterOrders('Delivered')">Delivered</button>
                <button class="filter-btn" onclick="filterOrders('Cancelled')">Cancelled</button>
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
                        <tr>
                            <td><strong>ORD1730885432123</strong></td>
                            <td>11/5/2024, 10:30 AM</td>
                            <td>Rahul Sharma</td>
                            <td>+91 98765 43210</td>
                            <td><strong>₹3,297</strong></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending" selected>Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(0)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730882156789</strong></td>
                            <td>11/5/2024, 9:15 AM</td>
                            <td>Priya Singh</td>
                            <td>+91 87654 32109</td>
                            <td><strong>₹4,548</strong></td>
                            <td><span class="status-badge status-processing">Processing</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Processing" selected>Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(1)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730878954321</strong></td>
                            <td>11/4/2024, 6:45 PM</td>
                            <td>Amit Patel</td>
                            <td>+91 76543 21098</td>
                            <td><strong>₹2,698</strong></td>
                            <td><span class="status-badge status-shipped">Shipped</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped" selected>Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(2)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730875123456</strong></td>
                            <td>11/4/2024, 3:20 PM</td>
                            <td>Sneha Reddy</td>
                            <td>+91 65432 10987</td>
                            <td><strong>₹5,497</strong></td>
                            <td><span class="status-badge status-delivered">Delivered</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered" selected>Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(3)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730871987654</strong></td>
                            <td>11/4/2024, 11:30 AM</td>
                            <td>Vikram Kumar</td>
                            <td>+91 54321 09876</td>
                            <td><strong>₹1,948</strong></td>
                            <td><span class="status-badge status-pending">Pending</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending" selected>Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(4)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730868765432</strong></td>
                            <td>11/3/2024, 8:00 PM</td>
                            <td>Anjali Mehta</td>
                            <td>+91 43210 98765</td>
                            <td><strong>₹3,847</strong></td>
                            <td><span class="status-badge status-processing">Processing</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Processing" selected>Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(5)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730865543210</strong></td>
                            <td>11/3/2024, 2:45 PM</td>
                            <td>Rajesh Verma</td>
                            <td>+91 32109 87654</td>
                            <td><strong>₹2,397</strong></td>
                            <td><span class="status-badge status-shipped">Shipped</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped" selected>Shipped</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(6)">View</button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ORD1730862321098</strong></td>
                            <td>11/3/2024, 10:00 AM</td>
                            <td>Kavita Desai</td>
                            <td>+91 21098 76543</td>
                            <td><strong>₹4,196</strong></td>
                            <td><span class="status-badge status-delivered">Delivered</span></td>
                            <td>
                                <select class="action-select">
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Shipped">Shipped</option>
                                    <option value="Delivered" selected>Delivered</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                                <button class="update-btn" onclick="alert('Status updated!')">Update</button>
                                <button class="view-btn" onclick="viewOrder(7)">View</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>