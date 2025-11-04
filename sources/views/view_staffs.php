<?php
    session_start();
    ob_start();
    include_once('../config/db.conn.php');
    
    // Kiểm tra nếu $conn đã được khởi tạo và kết nối thành công
    if ($conn) {
        // Truy vấn để lấy danh sách nhân viên
        $sql = "SELECT * FROM users WHERE role=0";
        $staffs = $conn->query($sql);
        // $staffs = $stmt->fetch_assoc();
        // Xử lý kết quả
        $id = $_SESSION['id'];
        $role = $_SESSION['role'];
    } else {
        $error = "Connection is not established yet.";
    }
    $imageDirectory = '../images/';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon5.ico">
    <link rel="stylesheet" type="text/css" href="../css/admin_home.css">
    <link rel="stylesheet" type="text/css" href="../css/product_catalog.css">
    <link rel="stylesheet" type="text/css" href="../css/create_sales.css">
    <title>Staff Management</title>
</head>
<body>
    <div class="header">
        <div class="row">
            <div class="hd">
                <h4>Point Of Sale</h4>
            </div>
            <div class="hd1">
                <h2>Staff Management</h2>
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
        <a href="../views/admin_home.php">Home</a>
        <a href="../views/view_staffs.php">Staffs</a>
        <a class="active" href="../views/customer_list.php">Customers</a>
        <a href="../views/product_catalog.php">Products</a>
        <a href="../transaction/index.php">Transaction</a>
        <a href="#about">Reports</a>
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
        <li><a href="../views/admin_home.php">Home</a></li>
        <li><a href="../views/view_staffs.php">Staffs</a></li>
        <li><a href="../views/customer_list.php">Customers</a></li>
        <li><a href="../views/product_catalog.php">Products</a></li>
        <li><a href="../transaction/index.php">Transaction</a></li>
        <li><a href="#about">Reports</a></li>
        <li><a href="../views/profile.php?id=$id&role=$role">Profile</a></li>
    </ul>

    <div class="Catalog">
        <div class="row">
            <div class="search_and_button">
                <div class="search_container">
                    <input id="frame_search" type="text" placeholder="Search">
                </div>
                <?php
                    echo '<button id="but">
                    <svg width="20px" height="15px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        viewBox="0 0 55 55" fill="white" style="enable-background:new 0 0 55 55;" xml:space="preserve">
                        <g>
                            <path d="M49,8.5v-8H0v47h7v7h48v-46H49z M2,45.5v-43h45v6H7v37H2z M53,52.5H9v-5v-37h40h4V52.5z" stroke="white" stroke-width="2"/>
                            <path d="M42,30.5H32v-10c0-0.553-0.447-1-1-1s-1,0.447-1,1v10H20c-0.553,0-1,0.447-1,1s0.447,1,1,1h10v10c0,0.553,0.447,1,1,1
                                s1-0.447,1-1v-10h10c0.553,0,1-0.447,1-1S42.553,30.5,42,30.5z" stroke="white" stroke-width="2"/>
                        </g>
                    </svg>
                        New Staff
                    </button>';
                ?>
            
            </div>
            <br>
            <table class="head">
                <tr>
                    <th>ID</th>
                    <th>Avatar</th>
                    <th>Fullname</th>
                    <th>Status</th>
                    <th>Action</th>
                    <th>View Detail</th>
                </tr>
            </table>
            <div class="scroll_table">
                <table id="sales_tab">
                    <tbody>
                        <?php
                            // Kiểm tra xem biến $staffs đã tồn tại và không phải là null hay không
                            if (isset($staffs)) {
                                // Sử dụng vòng lặp foreach để duyệt và hiển thị dữ liệu
                                while($staff = $staffs->fetch_assoc()) {
                                    // Hiển thị thông tin nhân viên và thêm liên kết chỉnh sửa
                                    echo "<tr>";
                                    echo "<td>" . $staff['id'] . "</td>";
                                    echo "<td><img src='" . $imageDirectory . $staff['avatar'] . "' alt='Avatar'  class='avatar'></td>";
                                    echo "<td>" . $staff['fullname'] . "</td>";
                                    if($staff['status']==0) {
                                        echo "<td>Active</td>";
                                    } else {
                                        echo "<td>Inactivate</td>";
                                    }
                                    
                                    echo "<td>";
                                    echo "<button id='buttLock' class='" . ($staff['status'] == 0 ? '' : 'lock') . "' onclick=\"toggleStatus(" . $staff['id'] . ", '" . $staff['status'] . "')\">";
                                    echo ($staff['status'] == 0) ? 'Lock' : "<span class='lock-label'><svg fill='#000000' width='20px' height='20px' viewBox='0 0 1024 1024' xmlns='http://www.w3.org/2000/svg'><path d='M800 384h-32V261.872C768 115.024 661.744 0 510.816 0 359.28 0 256 117.472 256 261.872V384h-32c-70.592 0-128 57.408-128 128v384c0 70.592 57.408 128 128 128h576c70.592 0 128-57.408 128-128V512c0-70.592-57.408-128-128-128zM320 261.872C320 152.784 394.56 64 510.816 64 625.872 64 704 150.912 704 261.872V384H320V261.872zM864.001 896c0 35.28-28.72 64-64 64h-576c-35.28 0-64-28.72-64-64V512c0-35.28 28.72-64 64-64h576c35.28 0 64 28.72 64 64v384zm-352-320c-35.344 0-64 28.656-64 64 0 23.632 12.96 44.032 32 55.12V800c0 17.664 14.336 32 32 32s32-14.336 32-32V695.12c19.04-11.088 32-31.504 32-55.12 0-35.344-28.656-64-64-64z'/></svg></span>Unlock";
                                    echo "</button>";
                                    echo "</td>";
                                    echo "<td><a href='../views/view_info_staff.php' id='detail'>View Detail</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                // Hiển thị một hàng trống nếu không có dữ liệu nhân viên
                                echo "<tr>";
                                echo "<td colspan='6'>No staff data available.</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hidden Dialog -->
    <div id="dialog" class="dialog">
        <div class="dialog_content">
            <h3>Add Staff</h3>
            <!-- Nội dung của hộp thoại -->
            <label class="lb" for="fn">Full name</label><br>
            <input type="text" id="fn" name="fn" placeholder="Full name"><br>
            
            <label class="lb" for="email">Email address</label><br>
            <input type="email" id="email" name="email" placeholder="Email address"><br>
            
            <label class="lb">Gender</label><br>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label><br>
            
            <label class="lb" for="phone">Phone number</label><br>
            <input type="text" id="phone" name="phone" placeholder="Phone number"><br>
            
            <button id="cancelButton">Cancel</button>
            <button id="addButton">Add</button>
        </div>
    </div>
    
    <div id="delete_dialog" class="delete_dialog">
        <form class="delete_dialog_content">
            <h3>Lock Account</h3>
            <!-- Nội dung của hộp thoại -->   
            <button type="submit" id="deleteButton">Confirm</button>         
            <button id="cancelButton2">Cancel</button>
        </form>
    </div>

    <div class="footer">
        <div class="jumbotron push-spaces">
            <strong>Copyright © 2024. All Rights Reserved.</strong>
        </div>
    </div>

    <script src = "../js/staff.js">
    </script>
</body>
</html>