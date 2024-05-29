<?php
    session_start();  
    include("header.html");   
    
    if (!isset($_SESSION['user'])) {
        header('Location: login.php');
        exit();
    }

    header('Location: home.php');
    include("footer.html");
?>