<?php
session_start();
ob_start();
require_once('../config/db.conn.php');
require_once('../Models/Account.php');

use Models\Account;

$account = new Account($conn);

if(isset($_GET['token'])) {
    $token = $_GET['token'];
    $email = $_GET['email'];
    
    // if($token===NULL) {

    // }

    // Ensure the token is not empty
    if(!empty($token)) {
        // Call the activateAccount method to activate the account and check token expiry
        $activation_result = $account->activateAccount($token);
        
        // Check the result returned by the activateAccount method
        if($activation_result === true) {
            // If the account is successfully activated and the token is still valid, update activated status
            $sql = "UPDATE staffs SET activated = 1 WHERE activation_token = '$token'";
            $stmt = $conn->query($sql);

            // Delete the token from the database after successful activation
            $sql_delete_token = "UPDATE staffs SET activation_token = NULL, expiry_time = NULL WHERE activation_token = '$token'";
            $stmt_delete_token = $conn->query($sql_delete_token);

            // Redirect to the sales_login.php page after updating
            header("Location: ../views/sales_login.php");
            exit(); // Ensure script execution stops after redirection
        } else {
            // If the token has expired or the account is already activated, check if the token is expired for more than 1 minute
            $sql_check_expiry = "SELECT activation_token, expiry_time FROM staffs WHERE activation_token = '$token'";
            $stmt_check_expiry = $conn->query($sql_check_expiry);
            $row = $stmt_check_expiry->fetch_assoc();
            
            if(!isset($row['activation_token'])) {
                echo "<p>Activation code has been used.</p>";
                echo "<p>Click below to go to the login page</p>";
                echo " <form action='../views/sales_login.php'>
                            <button type='submit'>Home</button>
                        </form>";
                exit();
            }
            // Add a button to resend activation email
            echo '<form method="post" action="../activate/resent_request.php">
                      <input type="hidden" name="email" value="'.$email.'">
                      <input type="hidden" name="token" value="'.$token.'">
                      <p>Your request has expired. Please click the button below to resend the request to the admin.</p>
                      <button type="submit" name="resend_activation">Resend Activation Email</button>
                  </form>';
                  
            exit(); 
        }
    }
} else {
    // If no token is sent, display an error message
    echo "<h2>Invalid activation link. Please request a new one.</h2>";
    
    exit(); // Terminate script execution after displaying the message
}


?>
