<?php
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["password"]);
    $_SESSION["isLoggedIn"] = false;
    header("Location: index.php");
    exit;
?>