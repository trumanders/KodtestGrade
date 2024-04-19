<?php
    session_start();    

    if (!isset($_SESSION["isLoggedIn"])) {
        $_SESSION["isLoggedIn"] = false;
    }        

    include("header.html");   

    if ($_SESSION["isLoggedIn"]){
        header("Location: home.php");        
    }
    else {
        header("Location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<?php
    include("footer.html");
?>