<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');

    // Kiểm tra nếu $conn đã được khởi tạo và kết nối thành công
    if ($conn) {
        $id = $_SESSION['id'];
        $role = $_SESSION['role'];
        // Xử lý kết quả
    } else {
        $error = "Connection is not established yet.";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon3.ico">
    <link rel="stylesheet" type="text/css" href="../css/admin_home.css">
    <link rel="stylesheet" type="text/css" href="../css/sales_home.css">
    <title>Home</title>

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../activate/logout.php?logout=true";
            }
        }
    </script>
    
</head>

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
        <a href="../views/sales_home.php">Home</a>
        <a class="active" href="../views/customer_list.php">Customers</a>
        <a href="../views/product_catalog.php">Products</a>
        <a href="../transaction/index.php">Transaction</a>
        <a href="#">Reports</a>
        <a href="../views/profile.php?id=$id&role=$role">Profile</a>
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
        <li><a href="../views/sales_home.php">Home</a></li>
        <li><a href="../views/customer_list.php">Customers</a></li>
        <li><a href="../views/product_catalog.php">Products</a></li>
        <li><a href="../transaction/index.php">Transaction</a></li>
        <li><a href="#">Reports</a></li>
        <li><a href="../views/profile.php?id=$id&role=$role">Profile</a></li>
    </ul>
    <div class="wrapper">
        <div class="t1">
            <h2>Click A Module Below To Get Started</h2>
        </div>
        <div class="row" id="home_module_list">
            <div class="module_item" title="Add, Update, Delete, and Search Customers.">
                <a href="../views/customer_list.php"><img src="https://demo.opensourcepos.org/images/menubar/customers.png" border="0" alt="Menubar Image"></a>
                <a href="../views/customer_list.php">Customers</a>
            </div>
            <div class="module_item" title="Add, Update, Delete, and Search Product.">
                <a href="../views/product_catalog.php"><img src="https://demo.opensourcepos.org/images/menubar/items.png" border="0" alt="Menubar Image"></a>
                <a href="../views/product_catalog.php">Products</a>
            </div>
            <div class="module_item" title="View and generate Reports.">
                <a href="#"><img src="https://demo.opensourcepos.org/images/menubar/reports.png" border="0" alt="Menubar Image"></a>
                <a href="#">Reports</a>
            </div>
            <div class="module_item" title="Process Sales and Returns.">
                <a href="../transaction/index.php"><img src="https://demo.opensourcepos.org/images/menubar/sales.png" border="0" alt="Menubar Image"></a>
                <a href="../transaction/index.php">Transaction</a>
            </div>
            <div class="module_item" title="Add, Update and Delete Profile.">
                <a href="../views/profile.php?id=$id&role=$role"><img src="https://demo.opensourcepos.org/images/menubar/expenses.png" border="0" alt="Menubar Image"></a>
                <a href="../views/profile.php?id=$id&role=$role">Profile</a>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="jumbotron push-spaces">
            <strong>Copyright © 2024. All Rights Reserved.</strong>
        </div>
    </div>
    <script>
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
</body>
</html>
