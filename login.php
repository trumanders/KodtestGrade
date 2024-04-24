<?php
    session_start();
    include("header.php");

    $emailValidationBorderStyle = "";
    $passwordValidationBorderStyle = "";

    if (isset($_POST["login"])) {
        
        if (empty($_POST["username"])) {
            $emailValidationBorderStyle = "border-color: red;";
        }
        else {
            $emailValidationBorderStyle = "";
        }

        if (empty($_POST["password"])) {
            $passwordValidationBorderStyle = "border-color: red;";
        }
        else {
            $emailValidationBorderStyle = "";
        }

        if (!empty($_POST["username"]) && !empty($_POST["password"])) {
            $_SESSION["username"] = $_POST["username"];            
            $_SESSION["password"] = $_POST["password"];

            // simulationg successful login
            $_SESSION["isLoggedIn"] = true;
            header("Location: home.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="styles.css">
    <script src="functions.js"></script>
</head>
<body>
<form action="login.php" method="post">
        <h2>Login</h2>

        <input
            type="text"
            name="username"
            placeholder="email"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'email', <?php echo isset($_POST["login"]) ? 'true' : 'false'; ?>)"
            style="<?php echo $emailValidationBorderStyle; ?>"
            value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ""; ?>">
        <br><br>

        <input
            type="password"
            name="password"
            placeholder="password"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'password', <?php echo isset($_POST["login"]) ? 'true' : 'false'; ?>)"
            style="<?php echo $passwordValidationBorderStyle; ?>"
            value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "";?>">
        <br><br>
        <!-- Login-button -->
        <input type="submit" name="login" value="Log in"><br><br>
        <br>Don't have an account? <a href="register.php">Create new accout</a><br><br>
    </form>
</body>
</html>

<?php 
    

    include("footer.html");
?>