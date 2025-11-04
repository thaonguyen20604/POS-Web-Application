<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');
    // require_once('../transaction/db.php');
    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css\style.css">
    <link rel="stylesheet" href="css\notification.css">
    <link rel="stylesheet" href="css\transaction_search_section.css">
    <link rel="stylesheet" href="css\transaction_search_result.css">
    <link rel="stylesheet" href="css\transaction_bill_info.css">
    <link rel="stylesheet" href="css\modal.css">
    <link rel="stylesheet" href="css\display.css">

    <title>Transaction Process</title>
    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../activate/logout.php?logout=true";
            }
        }
         // Đợi cho tất cả các phần tử trong DOM được tải xong trước khi thêm sự kiện click
         document.addEventListener('DOMContentLoaded', function () {
            // Lấy ra thẻ <a> có class là "icon"
            var menuIcon = document.querySelector('.icon');
            // Lấy ra menu list
            var menuList = document.getElementById('menuList');
            
            // Thêm sự kiện click cho biểu tượng menu
            menuIcon.addEventListener('click', function () {
                // Hiển thị hoặc ẩn menu list
                if (menuList.style.display === "block") {
                    menuList.style.display = "none";
                } else {
                    menuList.style.display = "block";
                }
            });
        });
    </script>
</head>
<script src="control\print_invoice.js"></script>
<script src="control\error_control.js"></script>
<script src="control\customer.js"></script>
<script src="control\product.js"></script>
<script src="control\modal.js"></script>
<script src="control\invoice.js"></script>
<body>
<div class="header">
        <div class="row">
            <div class="hd">
                <h4>Point Of Sale</h4>
            </div>
            <div class="hd1">
                <h2>Welcome to POS</h2>
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
                echo '<a href="../views/admin_home.php">Home</a>';
                echo '<a href="../views/view_staffs.php">Staffs</a>';
            }
            else {
                echo '<a href="../views/sales_home.php">Home</a>';
            }
        ?>
        <a class="active" href="../views/customer_list.php">Customers</a>
        <a href="../views/product_catalog.php">Products</a>
        <a href="../transaction/index.php">Transaction</a>
        <a href="../report/index.php">Reports</a>
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
                echo '<li><a href="../views/admin_home.php">Home</a></li>';
                echo '<li><a href="../views/view_staffs.php">Staffs</a></li>';
            }
            else {
                echo '<li><a href="../views/sales_home.php">Home</a></li>';
            }
        ?>
        <li><a href="../views/customer_list.php">Customers</a></li>
        <li><a href="../views/product_catalog.php">Products</a></li>
        <li><a href="../transaction/index.php">Transaction</a></li>
        <li><a href="../report/index.php">Reports</a></li>
        <li><a href='../views/profile.php?id=$id&role=$role'>Profile</a></li>
    </ul>

    <div class = "transaction-container">
        <div class="transaction-search-section">
            <div>
                <div id="method-adding-box" class="margin-3">
                    <select id="adding-method">
                        <option value="name">
                            Add by Name
                        </option>
                        <option value="id">
                            Add by ID
                        </option>
                        <option value="barcode">
                            Add by Barcode
                        </option>
                    </select>
                </div>

                <div id="search-box" class="margin-3">
                    <input type="text" id="search-input" name="search-input" placeholder="Search for an item">
                    <button class="search-button" id="search-button" onclick="load_product(document.getElementById('search-input').value, document.getElementById('adding-method').value)">
                        <img src="img/search.svg">
                    </button>
                </div>
            </div>

            <div style="width:10px;"></div>

            <div id="customer-type" class="margin-3">
                <select id="customer-type-choose">
                    <option value="anonymous">
                        Anonymous
                    </option>
                    <option value="save-info">
                        Save Infomation
                    </option>
                </select>
            </div>
            
            <script>
                document.getElementById('customer-type-choose').addEventListener('change', function() {
                    if (document.getElementById('customer-type-choose').value == 'save-info') {
                        document.getElementById('customer-info').style.display = 'flex';
                        disable_button('complete-transaction');
                    } else {
                        document.getElementById('customer-info').style.display = 'none';
                        enable_button('complete-transaction');
                    }
                });
            </script>

            <div id = "customer-info" style = "display: none;" class = "margin-3">
                <div id="customer-search-box" class="margin-3">
                    <input type="text" id="customer-search-input" name="customer-search-input" placeholder="Customer phone number">
                    <button class="search-button" id="customer-search-button" onclick="load_customer(document.getElementById('customer-search-input').value)">
                        <img src="img/search.svg">
                    </button>
                    <button id="customer-add-button" style="display:none;">+</button>
                </div>

                <div style="width:10px;">
                </div>

                <div style = "display: flex;">
                    <h3>
                        Customer Info:
                    </h3>
                </div>

                <div id="customer-id-display" class="margin-3">
                    <input readonly type="text" id="customer-id-display-box" placeholder="ID" style = "width: 50px;">
                </div>

                <div id="customer-name-display" class="margin-3">
                    <input readonly type="text" id="customer-name-display-box" placeholder="Name" style = "width: 150px;">
                </div>
                
                <div id="customer-phone-display" class="margin-3">
                    <input readonly type="text" id="customer-phone-display-box" placeholder="Phone" style = "width: 100px;">
                </div>

                <div id="customer-address-display" class="margin-3">
                    <input readonly type="text" id="customer-address-display-box" placeholder="Address" style = "width: fit-content;">
                </div>
            </div>   
        </div>

       

        <div id="search-result">
            <table id="search-result-table">
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Action</th>
                </tr>
            </table>
        </div>
    </div>

    <div id="bill-info">
            <div id = "title-and-price">
                <table id = "header-bill-table">
                    <tr>
                        <td>
                            <div id="bill-info-title">
                                <h4>
                                    Bill Information
                                </h4>
                            </div>
                        </td>
                        <td>
                            Total: <span id="total-cost">0</span> VND
                            <hr>
                            <div>
                                <input type="text" id = "customer-cash" placeholder="Customer give" onchange="calculate_change()" value="0">
                                <button class = "complete-transaction" id = "complete-transaction" onclick="add_invoice_to_db() ">
                                    Thanh toán
                                </button>
                            </div>
                            <hr>
                            Change: <span id="change-back">0</span> VND
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                </table>
            </div>
            <table id="bill-info-table">
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </table>
        </div>
    

    <!-- error box -->
    <div class="error-container float-message">
        <div class="error-title">Error Message</div>
        <div class="error-message">
            There was an error processing your request. Please try again later.
        </div>
    </div>

    <!-- success box -->
    <div class="success-container float-message">
        <div class="success-title">Success Message</div>
        <div class="success-message">
            There was an error processing your request. Please try again later.
        </div>
    </div>

    <div id = customer_modal class = modal>
        <div class = "modal-content">
            <span class="close" onclick="close_modal('customer_modal')">&times;</span>
            <div id = "form_container">
                <form id = "customer_form" onsubmit="add_customer(event); return false;">
                    <h2>Add New Customer</h2>
                    <table id = "modal_table">
                        <tr>
                            <td>
                                <label for="customer_name">Customer Name</label>
                            </td>
                            <td>
                                <input type="text" id="customer_name" name="customer_name">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="customer_phone">Customer Phone Number</label>
                            </td>
                            <td>
                                <input type="text" id="modal_customer_phone" name="customer_phone">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="customer_address">Customer Address</label>
                            </td>
                            <td>
                                <input type="text" id="customer_address" name="customer_address">
                            </td>
                        </tr>
                        <tr>
                            <td style='text-align: right' colspan='2'>
                                <button id="modal-add-button" onclick="close_modal('customer_modal')" type="submit">Add Customer</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById('customer_modal');

        var btn = document.getElementById("customer-add-button");

        btn.onclick = function() {
            modal.style.display = "block";
            var phone = document.getElementById('customer-search-input').value;
            document.getElementById('modal_customer_phone').value = phone;
        }

        function close_modal(modal_id) {
            document.getElementById(modal_id).style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>       
</body>
</html>
