<?php    
    session_start();
    include("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Hello <?php echo $_SESSION["username"]; ?>!<br>
    This is your diary.<br>
    Your password is <?php echo $_SESSION["password"]; ?>.<br>
</body>
</html>

<?php
    include("footer.html");
?>