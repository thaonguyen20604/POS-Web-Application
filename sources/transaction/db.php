<?php 
    // define('HOST','127.0.0.1');
    // define('USER','root');
    // define('PASS','');
    // define('DB','final');


    function open_database(){
        $servername = "localhost";
        $username = "hoaan";
        $password = "finalweb123";
        $database = "final";
        // $conn = new mysqli(HOST, USER, PASS, DB);
        $conn = new mysqli($servername, $username, $password, $database);
        if($conn->connect_error)
        {
            die('Connect error' . $conn->connect_error);
        }
        return $conn;
    }
?>