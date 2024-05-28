<?php
    // använd environnement variables här
    $db_server = "193.168.172.94";
    $db_user = "root";
    $db_password = "password";
    $db_name = "kodtestgrade";
    
    $connection = new mysqli($db_server, $db_user, $db_password, $db_name);
    
    if (!$connection) {
        echo "Could not connect to database: " . mysqli_connect_error();
    }
?>