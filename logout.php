<?php
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["password"]);
    $_SESSION["isLoggedIn"] = false;
    header("Location: index.php");
    exit;
?>