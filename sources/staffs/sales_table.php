<?php
session_start();
ob_start();
require_once('../config/db.conn.php');
require_once('../Models/Account.php');

$account = new Models\Account($conn);

try {
    $users = $account->getAllSales(); // Lấy chuỗi JSON từ phương thức
    // $sales = json_decode($salesJson, true);
    if (!empty($users)) {
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user["avatar"] . "</td>";
            echo "<td>" . $user["fullname"] . "</td>";
            echo "<td>" . $user["email"] . "</td>";
            echo "<td>" . $user["gender"] . "</td>";
            echo "<td>" . $user["phone"] . "</td>";
            // if(isset($_SESSION['user_role']) && $_SESSION['user_role']===1) {
                echo "<td><a href='#' class='edit'><svg fill='#000000' width='20px' height='20px' viewBox='0 0 24 24' xmlns='http://www.w3.org/2000/svg'><path d='M21,12a1,1,0,0,0-1,1v6a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V5A1,1,0,0,1,5,4h6a1,1,0,0,0,0-2H5A3,3,0,0,0,2,5V19a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V13A1,1,0,0,0,21,12ZM6,12.76V17a1,1,0,0,0,1,1h4.24a1,1,0,0,0,.71-.29l6.92-6.93h0L21.71,8a1,1,0,0,0,0-1.42L17.47,2.29a1,1,0,0,0-1.42,0L13.23,5.12h0L6.29,12.05A1,1,0,0,0,6,12.76ZM16.76,4.41l2.83,2.83L18.17,8.66,15.34,5.83ZM8,13.17l5.93-5.93,2.83,2.83L10.83,16H8Z'/></svg></a></td>";
                echo "<td><a href='#'><svg width='20px' height='20px' viewBox='0 0 24 24' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z' fill='#0D0D0D'/></svg></a></td>";
            // }
            echo "</tr>";
        }
    }
} catch (Exception $e) {
    echo "<tr><td colspan='9'>Error: " . $e->getMessage() . "</td></tr>";
}

$conn = null;
?>
