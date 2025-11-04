<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');
    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối không thành công: " . $conn->connect_error);
    }

    // Truy vấn dữ liệu từ bảng products
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);

    $id = $_SESSION['id'];
    $role = $_SESSION['role'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon4.ico">
    <link rel="stylesheet" type="text/css" href="../css/admin_home.css">
    <link rel="stylesheet" type="text/css" href="../css/product_catalog.css">
    <title>Product</title>
</head>
<body>
    <div class="header">
        <div class="row">
            <div class="hd">
                <h4>Point Of Sale</h4>
            </div>
            <div class="hd1">
                <h2>Product Catalog</h2>
            </div>

            <div id="notification" class="notification"></div>
            
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
                echo '<li><a href="../views/admin_home.php">Home</a></li>';
                echo "<li><a href='../views/view_staffs.php'>Staffs</a></li>";
            }
            else {
                echo '<li><a href="../views/sales_home.php">Home</a></li>';
            }
        ?>
        <li><a href="../views/customer_list.php">Customers</a></li>
        <li><a href="../views/product_catalog.php">Products</a></li>
        <li><a href="../transaction/index.php">Transaction</a></li>
        <li><a href="#about">Reports</a></li>
        <li><a href='../views/profile.php?id=$id&role=$role'>Profile</a></li>
    </ul>
    <br>
    <div class="Catalog">
        <div class="row">
            <div class="search_and_button">
                <div class="search_container">
                    <input id="frame_search" type="text" placeholder="Search">
                </div>
                <?php
                if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                    echo '<button id="but">
                        <svg width="20px" height="15px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                            viewBox="0 0 55 55" fill="white" style="enable-background:new 0 0 55 55;" xml:space="preserve">
                            <g>
                                <path d="M49,8.5v-8H0v47h7v7h48v-46H49z M2,45.5v-43h45v6H7v37H2z M53,52.5H9v-5v-37h40h4V52.5z" stroke="white" stroke-width="2"/>
                                <path d="M42,30.5H32v-10c0-0.553-0.447-1-1-1s-1,0.447-1,1v10H20c-0.553,0-1,0.447-1,1s0.447,1,1,1h10v10c0,0.553,0.447,1,1,1
                                    s1-0.447,1-1v-10h10c0.553,0,1-0.447,1-1S42.553,30.5,42,30.5z" stroke="white" stroke-width="2"/>
                            </g>
                        </svg>
                        New Product
                    </button>';
                }
                ?>
            </div>
            <br>
            <table class="head">
                <tr>
                    <td>ID</td>
                    <td>Barcode</td>
                    <td>Name</td>
                    <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                            echo "<td>Import Price</td>";
                        }
                    ?>
                    <td>Retail Price</td>
                    <td>Category</td>
                    <td>Quantity</td>
                    <td>Creation Date</td>
                    <td>Update Date</td>
                    <td>Description</td>
                    <?php
                        if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                            echo "<td>Edit</td>";
                            echo "<td>Delete</td>";
                        }
                    ?>
                </tr>
            </table>
            <div class="scroll_table">
                <table id="product_tab">
                    <tbody>
                        <?php
                            // Lặp qua kết quả và tạo các hàng của bảng HTML
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["product_id"] . "</td>";
                                    echo "<td>" . $row["barcode"] . "</td>";
                                    echo "<td>" . $row["productName"] . "</td>";
                                    if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                        echo "<td>" . $row["imprice"] . "</td>";
                                    }
                                    echo "<td>" . $row["reprice"] . "</td>";
                                    echo "<td>" . $row["category_id"] . "</td>";
                                    echo "<td>". $row["quantity"] . "</td>"; 
                                    echo "<td>" . $row["created_date"] . "</td>";
                                    echo "<td>" . $row["update_date"] . "</td>";
                                    echo "<td>" . $row["description"] . "</td>";
                                    // Thêm nút "Edit" vào cột mới
                                    if(isset($_SESSION['role']) && $_SESSION['role'] == 1) {
                                        echo "<td><a href='#' class='edit'><svg fill='#000000' width='20px' height='20px' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z'/></svg></a></td>";
                                        echo "<td><a href='#' class='delete'><svg width='20px' height='20px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z' fill='#0D0D0D'/></svg></a></td>";    
                                    }
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="dialog" class="dialog">
        <form class="dialog_content" method="POST" action="../product/add_product.php">
            <h3>Add New Product</h3>
            <!-- Nội dung của hộp thoại -->
            <!-- <label for="product_Id">ID</label><br>
            <input type="text" id="product_Id" name="product_Id" placeholder="productId"><br> -->

            <label for="barcode">Barcode</label><br>
            <input type="text" id="barcode" name="barcode" placeholder="Barcode"><br>
            
            <label for="name">Product name</label><br>
            <input type="text" id="name" name="name" placeholder="Product Name"><br>

            <label for="import_price">Import price</label><br>
            <input type="text" id="import_price" name="import_price" placeholder="Import price"><br>
            
            <label for="retail_price">Retail price</label><br>
            <input type="text" id="retail_price" name="retail_price" placeholder="Retail price"><br>
            
            <label for="category">Category</label><br>
            <input type="text" id="category" name="category" placeholder="Category"><br>
            
            <label for="quantity">Quantity</label><br>
            <input type="number" step="1" id="quantity" name="quantity" placeholder="Quantity"><br>
            
            <label for="description">Description</label><br>
            <input type="text" id="description" name="description" placeholder="Description"><br>
            
            <button id="cancelButton">Cancel</button>
            <button id="addButton" type="submit" onclick="showNotification(<?php $error ?>)">Add</button>
        </form>
    </div>

    <div id="update_dialog" class="update_dialog" style="display: none;">
        <form class="update_dialog_content" id="update_dialog_content" method="POST" action="../product/update_product.php">
            <h3>Updating Product Information</h3>
            <!-- Nội dung của hộp thoại -->
            <label for="productId">ID</label><br>
            <div id="showId" name="showId" placeholder="ID"></div> <br>
            <input type="hidden" id="productId" name="productId" placeholder="ID"> <br>

            <label for="upbarcode">Barcode</label><br>
            <input type="text" id="upbarcode" name="upbarcode" placeholder="Barcode"><br>
            
            <label for="upname">Product name</label><br>
            <input type="text" id="upname" name="upname" placeholder="Product Name"><br>
            
            <label for="upimport_price">Import price</label><br>
            <input type="text" id="upimport_price" name="upimport_price" placeholder="Import price"><br>
            
            <label for="upretail_price">Retail price</label><br>
            <input type="text" id="upretail_price" name="upretail_price" placeholder="Retail price"><br>
            
            <label for="upcategory">Category</label><br>
            <input type="text" id="upcategory" name="upcategory" placeholder="Category"><br>
            
            <label for="upquantity">Quantity</label><br>
            <input type="number" step="1" id="upquantity" name="upquantity" placeholder="Quantity"><br>

            <label for="updescription">Description</label><br>
            <input type="text" id="updescription" name="updescription" placeholder="Description"><br>
            
            <button id="cancelButton1">Cancel</button>
            <button type = "submit" id="updateButton" onclick='showNotification("<?php echo $error ?>")'>Update</button>
        </form>
    </div>

    <div id="delete_dialog" class="delete_dialog">
        <form class="delete_dialog_content">
            <h3>Delete Product</h3>
            <!-- Nội dung của hộp thoại -->   
            <button type="submit" id="deleteButton">Delete</button>         
            <button id="cancelButton2">Cancel</button>
        </form>
    </div>
    </div>


    <div class="notification">
    <!-- Đoạn mã PHP và JavaScript để hiển thị thông báo lỗi -->
    <?php 
    $error = isset($_GET['error']) ? $_GET['error'] : "";
    if (!empty($error)): ?>
        <div class="error-notification">
            <?php echo $error; ?>
        </div>
        <div class="overlay"></div>
        <script>
            setTimeout(function() {
                var errorNotification = document.querySelector('.error-notification');
                var overlay = document.querySelector('.overlay');

                // Hiển thị overlay
                overlay.style.display = 'block';

                setTimeout(function() {
                    errorNotification.style.opacity = '0';
                    overlay.style.opacity = '0';
                    setTimeout(function() {
                        errorNotification.style.display = 'none';
                        overlay.style.display = 'none';
                    }, 500); // Đợi cho hiệu ứng kết thúc trước khi ẩn
                }, 1500);
            }, 0);
        </script>
    <?php endif; ?>
</div>




    <div class="footer">
        <div class="jumbotron push-spaces">
            <strong>Copyright © 2024. All Rights Reserved.</strong>
        </div>
    </div>

    <script src = "../js/product.js"></script>
</body>
</html>