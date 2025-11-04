<?php
session_start();
ob_start();
// Include the database connection file and the Customer model
require_once('../config/db.conn.php');
require_once('../Models/Customer.php');

// Create a new instance of the Customer model and pass the database connection
$customerModel = new Models\Customer($conn);
// Get customers data from the database
$customers = $customerModel->getAllCustomers();

$id = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Interface</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <header>
        <h1>Sales Interface</h1>
    </header>
    <section id="customer-info">
        <h2>Customer Information</h2>
        <div id="customer-details">
            <!-- Display customer information -->
            <thead>
                <tr>
                    <td>Total Amount</td>
                    <td>Amount Given</td>
                    <td>Excess Amount</td>
                    <td>Purchase Date</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Selling Price</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                    <div class="customer">
                        <tr>
                            <td><?php echo $customer['customer_name'] ?></td>
                            <td><?php echo $customer['phone']?></td>
                            <td><?php echo $customer['customer_address']?></td>
                        </tr>
                        
                    </div>
                <?php endforeach; ?>
            </tbody> 
        </div>
    </section>
    <section id="purchase-history">
        <h2>Purchase History</h2>
        <table id="purchase-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Total Amount</th>
                    <th>Amount Given</th>
                    <th>Excess Amount</th>
                    <th>Products</th>
                </tr>
            </thead>
            <tbody>
                <!-- Purchase history will be populated here -->
            </tbody>
        </table>
    </section>
    <section id="order-details">
        <h2>Order Details</h2>
        <div id="order-details-container">
            <!-- Order details will be displayed here -->
        </div>
    </section>
    <script>
        // JavaScript code for fetching and displaying data
    </script>
</body>
</html>
