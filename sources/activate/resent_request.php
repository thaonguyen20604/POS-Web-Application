<?php
session_start();
ob_start();
require_once('../config/db.conn.php');
require_once('../Models/Account.php');

use Models\Account;

$account = new Account($conn);

// Handle resend activation email button click
if(isset($_POST['resend_activation'])) {
    $email = $_POST['email'];
    $token = $_POST['token'];
    
    if($account->resendRequestToAdmin($email)) {
        echo "<p>An activation link has been resent to your email. Please check your inbox and spam folder.</p>";
    }
    else {
        echo "<p>Error resending activation email. Please try again later.</p>";
    }
} else {
    echo "Invalid activation link.";
    exit();
}
?>
