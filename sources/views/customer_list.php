<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');
    require_once('../Models/Customer.php');

    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
    
    $customerModel = new Models\Customer($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon7.ico">
    <link rel="stylesheet" type="text/css" href="../css/admin_home.css">
    <link rel="stylesheet" type="text/css" href="../css/product_catalog.css">
    <link rel="stylesheet" type="text/css" href="../css/customer_list.css">
    <title>Customer</title>
</head>
<body>
    <div class="header">
        <div class="row">
            <div class="hd">
                <h4>Point Of Sale</h4>
            </div>
            <div class="hd1">
                <h2>Customer List</h2>
            </div>
            <div class="hd2">
                <a href="#" onclick="confirmLogout()">
                    <svg width="17px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	                viewBox="0 -30 600 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                        <polygon style="fill:white;" points="14.645,255.999 163.785,342.107 163.785,169.893 "/>
                        <g>
	                        <path style="fill:white;" d="M289.729,200.716H178.43v-30.824c0-5.233-2.791-10.067-7.322-12.682
                            c-4.531-2.616-10.114-2.616-14.645,0L7.322,243.317C2.791,245.933,0,250.767,0,255.999s2.791,10.067,7.322,12.682l149.141,86.107
                            c2.266,1.309,4.793,1.962,7.322,1.962c2.528,0,5.057-0.655,7.322-1.962c4.531-2.616,7.322-7.45,7.322-12.682v-30.824h111.299
                            c8.087,0,14.645-6.556,14.645-14.645v-81.278C304.373,207.272,297.817,200.716,289.729,200.716z M149.141,316.742L43.934,255.999
                            l105.207-60.743v20.104v81.278V316.742z M275.084,281.993H178.43v-51.988h96.654V281.993z"/>
                            <path style="fill:white;" d="M497.355,494.995h-448.7c-8.088,0-14.645-6.556-14.645-14.645V378.352
                            c0-8.088,6.556-14.645,14.645-14.645S63.3,370.264,63.3,378.352v87.354h419.411V46.294H63.3v87.354
                            c0,8.088-6.556,14.645-14.645,14.645s-14.645-6.556-14.645-14.645V31.65c0-8.088,6.556-14.645,14.645-14.645h448.7
                            c8.087,0,14.645,6.556,14.645,14.645v448.7C512,488.438,505.442,494.995,497.355,494.995z"/>
                        </g>
                        <rect x="341.834" y="128.096" style="fill:white;" width="85.915" height="255.797"/>
                        <path style="fill:white;" d="M427.748,398.541h-85.914c-8.087,0-14.645-6.556-14.645-14.645V128.104
                        c0-8.088,6.558-14.645,14.645-14.645h85.914c8.087,0,14.645,6.556,14.645,14.645v255.793
                        C442.393,391.985,435.836,398.541,427.748,398.541z M356.479,369.252h56.625V142.748h-56.625V369.252z"/>
                    </svg>
                </a>
                <a href="#" onclick="confirmLogout()">Log Out</a>
            </div>
        </div>
    </div>

    <div class="topnav" id="myTopnav">
        <?php
            if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                echo "<a href='../views/admin_home.php'>Home</a>";
                echo "<a href='../views/view_staffs.php'>Staffs</a>";
            }
            else {
                echo "<a href='../views/sales_home.php'>Home</a>";
            }
        ?>
        <a class="active" href="../views/customer_list.php">Customers</a>
        <a href="../views/product_catalog.php">Products</a>
        <a href="../transaction/index.php">Transaction</a>
        <a href="#about">Reports</a>
        <a href='../views/profile.php?id=$id&role=$role'>Profile</a>
    </div>

    <div class="topnav" id="myTopnav1">
        <a href="#" class="icon" onclick="toggleMenu()">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;" xml:space="preserve">
                <style type="text/css">
                    .st0{fill: black;}
                </style>
                <g>
                    <path class="st0" d="M315,0H15C6.716,0,0,6.716,0,15v300c0,8.284,6.716,15,15,15h300c8.284,0,15-6.716,15-15V15
                        C330,6.716,323.284,0,315,0z M300,300H30V30h270V300z"/>
                    <path class="st0" d="M90.001,109.999h150c8.284,0,15-6.716,15-15s-6.716-15-15-15h-150c-8.284,0-15,6.716-15,15S81.717,109.999,90.001,109.999z
                        "/>
                    <path class="st0" d="M90.001,179.999h150c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-150c-8.284,0-15,6.716-15,15
                        C75.001,173.283,81.717,179.999,90.001,179.999z"/>
                    <path class="st0" d="M90.001,249.999h150c8.284,0,15-6.716,15-15c0-8.284-6.716-15-15-15h-150c-8.284,0-15,6.716-15,15
                        C75.001,243.283,81.717,249.999,90.001,249.999z"/>
                </g>
            </svg>
        </a>    
    </div>
    <ul class="menu_list" id="menuList">
        <?php
            if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                echo "<li><a href='../views/admin_home.php'>Home</a></li>";
                echo "<li><a href='../views/view_staffs.php'>Staffs</a></li>";
            }
            else {
                echo "<li><a href='../views/sales_home.php'>Home</a></li>";
            }
        ?>
        <li><a href="../views/customer_list.php">Customers</a></li>
        <li><a href="../views/product_catalog.php">Products</a></li>
        <li><a href="../transaction/index.php">Transaction</a></li>
        <li><a href="#about">Reports</a></li>
        <li><a href='../views/profile.php?id=$id&role=$role'>Profile</a></li>
    </ul>

    <div class="Catalog">
        <div class="row" id="default_view">
            <div class="search-and-button">
                <div class="search-container">
                    <input id="frame_search" type="text" placeholder="Search">
                </div>                
            </div>
            <table class="head">
                <tr>
                    <td>Customer ID</td>
                    <td>Name</td>
                    <td>Phone Number</td>
                    <td>Address</td>
                    <td>Purchase History</td>
                    <td>Edit</td>
                </tr>
            </table>
            <div class="scroll_table">
                <table id="customer_tab" >
                    <tbody>
                        <?php
                            try {
                                $customers = $customerModel->getAllCustomers();
                                if (!empty($customers)) {
                                    foreach ($customers as $customer) {
                                        echo "<tr>";
                                        echo "<td>" . $customer["customer_id"] . "</td>";
                                        echo "<td>" . $customer["customer_name"] . "</td>";
                                        echo "<td>" . $customer["phone"] . "</td>";
                                        echo "<td>" . $customer["customer_address"] . "</td>";
                                        echo '<td> <a href="#" class="purchase" data-customer-id="' . $customer["customer_id"] . '">
                                            <svg width="20px" height="20px" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill="#000000"><path fill-rule="evenodd" clip-rule="evenodd" d="M13.507 12.324a7 7 0 0 0 .065-8.56A7 7 0 0 0 2 4.393V2H1v3.5l.5.5H5V5H2.811a6.008 6.008 0 1 1-.135 5.77l-.887.462a7 7 0 0 0 11.718 1.092zm-3.361-.97l.708-.707L8 7.792V4H7v4l.146.354 3 3z"/></svg><br>
                                            View history purchase
                                        </a> </td>';
                                        echo '<td><a href="#" class="edit">
                                            <svg fill="#000000" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z"/></svg>
                                        </a> </td>';
                                        echo "</tr>";
                                    }
                                }
                            } catch (Exception $e) {
                                echo "<tr><td colspan='5'>Error: " . $e->getMessage() . "</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>                    
            
        </div>
        <div id="editDialog" class="dialog">
            <div class="dialog_content">
                <h2>Edit Customer Information</h2>
                <form id="editForm">
                    <label for="name">Name</label><br>
                    <input type="text" id="name" name="name"><br>
                    <label for="phoneNumber">Phone Number</label><br>
                    <input type="text" id="phoneNumber" name="phoneNumber"><br>
                    <label for="address">Address</label><br>
                    <input type="text" id="address" name="address"><br>
                    <button type="button" id="cancelButton" onclick="saveChanges()">Cancel</button>
                    <button type="button" id="saveButton" onclick="saveChanges()">Save</button>
                </form>
            </div>
        </div>

        <div class="row" id="purchase_history_view" style="display: none;">
            <h3>History Purchase</h3>
            <!-- <button active="click">Back</button> <br> -->
            <table class="head">
                <tr>
                    <td>Order ID</td>
                    <td>Customer ID</td>
                    <td>Total amount</td>
                    <td>Amount of money given by customer</td>
                    <td>Excess amount paid back</td>
                    <td>Date of purchase</td>
                    <td>Detais of the order</td>
                </tr>
            </table>
            <div class="scroll_table1" id="customer_tab_container">
                <table >
                    <tbody>
                    </tbody>
                </table>
            </div>                       
        </div>

        <div class="row" id="details_view" style="display: none;">
            <div class="total">
                <h3>Details Of Order</h3>
                <!-- <h4>Grand Total:</h4>                 -->
            </div>
            <table class="head">
                <tr>
                    <td>Detail ID</td>
                    <td>Order ID</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Selling Price</td>
                </tr>
            </table>
            <div class="scroll_table" id="order_tab_container">
                <table>
                    <tbody>
                    </tbody>
                </table>
            </div>                    
            
        </div>
    </div>
    
    <div class="footer">
        <div class="jumbotron push-spaces">
            <strong>Copyright © 2024. All Rights Reserved.</strong>
        </div>
    </div>

    <script src = "../js/customer_list.js"></script>
</body>
</html>