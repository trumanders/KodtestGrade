<?php
    // använd environnement variables här
    $db_server = "localhost";
    $db_user = "root";
    $db_password = "password";
    $db_name = "kodtestgrade";
    
    $connection = mysqli_connect($db_server, $db_user, $db_password, $db_name);
    
    if (!$connection) {
        echo "Could not connect to database: " . mysqli_connect_error();
    } else {
        echo "Connection established - yipiie!";
    }
?>