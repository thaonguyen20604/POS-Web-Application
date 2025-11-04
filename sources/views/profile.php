<?php
    session_start();
    ob_start();
    require_once('../config/db.conn.php');

    // Kiểm tra nếu $conn đã được khởi tạo và kết nối thành công
    if ($conn) {
        $id = $_SESSION['id'];
        $role = $_SESSION['role'];
        // Truy vấn để lấy danh sách nhân viên
        $sql = "SELECT * FROM users WHERE role='$role' and id = '$id'";
        $users = $conn->query($sql);
        $user = $users->fetch_assoc();
        // Xử lý kết quả
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
    <link rel="shortcut icon" type="image/x-icon" href="../images/icon7.ico">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <title>Profile</title>
</head>
<body>
    <div class="header">
        <div class="row">
            <div class="hd">
                <h4>Point Of Sale</h4>
            </div>
            <div class="hd1">
                <h2>My Profile</h2>
            </div>

            <div id="success" class="success"></div>

            

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
            if($role == 1) {
                echo '<a href="../views/admin_home.php">Home</a>';
                echo '<a href="../views/view_staffs.php">Staffs</a>';
                // echo '<a href="../views/admin_profile.php">Profile</a>';
            } else {
                echo '<a href="../views/sales_home.php">Home</a>';
                // echo '<a href="../views/staff_profile.php">Profile</a>';
            }
        ?>
        <a class="active" href="../views/customer_list.php">Customers</a>
        <a href="../views/product_catalog.php">Products</a>
        <a href="../transaction/index.php">Transaction</a>
        <a href="#about">Reports</a>
        <a href="../views/profile.php?id=$id&role=$role">Profile</a>
    </div>
    <div class="topnav" id="myTopnav1">
        <a href="#" class="icon">
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
            if($role == 1) {
                echo '<li><a href="../views/admin_home.php">Home</a></li>';
                echo '<li><a href="../views/view_staffs.php">Staffs</a></li>';
                // echo '<li><a href="../views/admin_profile.php">Profile</a></li>';
            } else {
                echo '<li><a href="../views/sales_home.php">Home</a></li>';
                // echo '<li><a href="../views/staff_profile.php">Profile</a></li>';
            }
        ?>
        <li><a class="active" href="../views/customer_list.php">Customers</a></li>
        <li><a href="../views/product_catalog.php">Products</a></li>
        <li><a href="../transaction/index.php">Transaction</a></li>
        <li><a href="#about">Reports</a></li>
        <li><a href="../views/profile.php?id=$id&role=$role">Profile</a></li>
    </ul>
    
    <div class="content">
        <div class="infTab">
            <div id="picFrame">
                <div id="img">
                    <?php
                        if(isset($user['avatar'])) {
                            echo "<td><img src='" . $imageDirectory . $user['avatar'] . "' alt='Avatar' class='avatar'></td>";
                        }
                        else {
                            $user['avatar'] = "default_image.jpg";
                            echo "<td><img src='" . $imageDirectory . $user['avatar'] . "' alt='Avatar' class='avatar'></td>";

                        }
                    ?>
                </div>
                <form method="POST" action="../activate/update_avatar.php?id=<?php echo $user['id']; ?>&role=<?php echo $user['role']; ?>" enctype="multipart/form-data">
                    <div class="uploadDiv">
                        <label for="image" class="btn">Choose File</label>
                        <input id="image" type="file" accept="image/*" name = "image">
                        <div id="fileNameContainer">No file choosen</div>
                    </div>
                    <div class="uploadDiv">
                        <button id="upload" type="submit">Upload</button>
                    </div>
                </form>
            </div>

            <div id="infFrame">
                <thead>
                    <h2>Personal Information</h2>
                </thead>
                <tbody>
                <form id="update_dialog_content">
                    <table>
                        <tr>
                            <td><label for="name">Full name</label></td>
                            <td><input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['fullname']); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="username">Username</label></td>
                            <!-- <td><input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>"></td> -->
                            <td id="active"><?php echo $user['username'] ?></td>
                        </tr>
                        <tr>
                            <td><label for="email">Email address</label></td>
                            <td><input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="phone">Phone</label></td>
                            <td><input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>"></td>
                        </tr>
                        <tr>
                            <td><label for="gender">Gender</label></td>
                            <td>
                                <select id="gender" name="gender">
                                    <option value="" <?php echo is_null($user['gender']) ? 'selected' : ''; ?>></option>
                                    <option value="male" <?php echo ($user['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                                    <option value="female" <?php echo ($user['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                                    <option value="other" <?php echo ($user['gender'] == 'other') ? 'selected' : ''; ?>>Other</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="role">Role</label></td>
                            <td id="active"><?php echo ($user['role'] == 1) ? 'Admin' : 'Staff'; ?></td>
                        </tr>
                        <tr>
                            <td id="state">Status</td>
                            <td id="active"><?php echo ($user['status'] == 0) ? 'Active' : 'Inactive'; ?></td>
                        </tr>
                    </table>
                    <button id="save" type="button" onclick="updateProfile()">Save</button>
                </form>
                <a href="../views/reset_password.php"><button id="change" type="button">Change Password</button></a>
                
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

            </tbody>
            </div>
        </div>
    </div>

    <div id="update_dialog" class="update_dialog">
        <div class="dialog_content">
            <h3 style="font-family: Calibri">Are you sure you want to change information?</h3>
            <button id="cancelButton2">Cancel</button>
            <button type="submit" id="updateButton">Yes</button>
        </div>
    </div>
    
    <div class="notification">
    <!-- Đoạn mã PHP và JavaScript để hiển thị thông báo lỗi -->
        <?php 
        $error = isset($_GET['error_img']) ? $_GET['error_img'] : "";
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
    <script src="../js/profile.js"></script>
</body>
</html>