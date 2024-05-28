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
    This is your diary.<br><br>  
    <a href="editDiaryEntry.php"><h2> Add diary entry</h2></a>   
    <br><br>
    Your diary entries

    <!-- lista alla inlägg som användaren har, med länk i form av datum -->
    
</body>
</html>

<?php
    include("footer.html");
?>