<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/admin_login.css">
    <link rel="icon" type="image/x-icon" href="../images/icon.ico">
</head>
<body>
    <main>
    <div class="container">
        <div class="logo">
        <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
	 width="800px" height="800px" viewBox="0 0 32 32" xml:space="preserve">
<style type="text/css">
	.stone_een{fill:#8998a8;}
</style>
<path class="stone_een" d="M16,2C8.268,2,2,8.268,2,16s6.268,14,14,14s14-6.268,14-14S23.732,2,16,2z M28.618,17.212
	c-1.808,0.767-3.713,1.174-5.623,1.174c-2.205,0-4.406-0.51-6.442-1.523c0.248,3.939,2.169,7.508,5.306,9.88
	c0.293,0.221,0.251,0.668-0.077,0.832c-0.014,0.007-0.028,0.014-0.041,0.021c-0.164,0.081-0.362,0.062-0.508-0.049
	c-3.371-2.552-5.444-6.399-5.705-10.634c-3.281,2.182-5.42,5.634-5.907,9.536c-0.045,0.364-0.452,0.55-0.758,0.349
	c-0.012-0.008-0.023-0.015-0.035-0.023c-0.153-0.101-0.235-0.283-0.213-0.465c0.526-4.195,2.827-7.92,6.358-10.261
	c-3.53-1.75-7.586-1.876-11.209-0.348c-0.334,0.141-0.701-0.111-0.682-0.473c0.001-0.016,0.002-0.031,0.003-0.047
	c0.01-0.185,0.125-0.351,0.296-0.423c3.896-1.642,8.269-1.511,12.063,0.377c-0.249-3.934-2.169-7.508-5.304-9.88
	C9.848,5.034,9.89,4.588,10.218,4.424c0.013-0.007,0.027-0.013,0.04-0.02c0.164-0.081,0.362-0.062,0.508,0.049
	c3.37,2.552,5.442,6.404,5.703,10.635c3.278-2.18,5.421-5.634,5.909-9.535c0.045-0.363,0.452-0.55,0.758-0.349
	c0.01,0.007,0.021,0.014,0.031,0.021c0.153,0.101,0.236,0.283,0.213,0.465c-0.527,4.195-2.828,7.922-6.356,10.262
	c3.532,1.751,7.586,1.877,11.208,0.347c0.335-0.141,0.701,0.112,0.682,0.475c0,0.005-0.001,0.01-0.001,0.014
	C28.904,16.974,28.789,17.14,28.618,17.212z"/>
</svg>
        </div>
        <section class="login">
            <form action="../admin/admin_authenticate.php" method="post" class="clearfix">        
                <h2>ADMIN LOGIN</h2>    
                <!-- <label for="username">User Name</label><br> -->
                <input type="text" id="username" name="username" placeholder="Username">
                <!-- <label for="password">Password</label><br> -->
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <div>
                    <?php
                        if (isset($_GET['error'])) {
                            $error = $_GET['error'];
                            echo "<div class='alert alert-danger'>$error</div>";
                        }
                    ?>
                    <button id="butt" type="submit">Login</button><br>
                </div>
                <!-- <p><a href="../admin/forgot.php">Forgot your password?</a></p> -->
                <br>
            </form>
        </section>
    </main>
    <footer class="footer">
        <span>Copyright</span>
        <svg viewBox="0 0 24 24" id="meteor-icon-kit__regular-copyright" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.6707 5.96795C8.36196 6.14922 5.82664 8.97844 6.00791 12.2872C6.18919 15.5959 9.01841 18.1313 12.3272 17.95C13.8706 17.8654 15.3173 17.1712 16.3489 16.02L16.4299 15.9296C16.7985 15.5183 16.7638 14.8861 16.3525 14.5175C15.9412 14.149 15.309 14.1836 14.9404 14.5949L14.8595 14.6852C14.1818 15.4414 13.2316 15.8974 12.2177 15.953C10.0119 16.0738 8.12577 14.3836 8.00492 12.1778C7.88407 9.97195 9.57428 8.0858 11.7801 7.96495C12.794 7.90941 13.7883 8.25889 14.5445 8.93651L14.6349 9.01747C15.0462 9.38605 15.6784 9.35141 16.047 8.94011C16.4155 8.5288 16.3809 7.89659 15.9696 7.52801L15.8792 7.44705C14.728 6.41543 13.2142 5.88339 11.6707 5.96795Z" fill="#758CA3"/><path fill-rule="evenodd" clip-rule="evenodd" d="M24 12C24 18.6274 18.6274 24 12 24C5.37258 24 0 18.6274 0 12C0 5.37258 5.37258 0 12 0C18.6274 0 24 5.37258 24 12ZM22 12C22 17.5228 17.5228 22 12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12Z" fill="#758CA3"/></svg>
        <span>2024. All Rights Reserved.</span>
    </footer>
</body>
</html>
