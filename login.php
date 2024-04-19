<?php
    session_start();
    include("header.php");

    $usernameValidationText = "";
    $passwordValidationText = "";

    if (isset($_POST["login"])) {

        if (empty($_POST["username"])) {
            $usernameValidationText = "Must enter a username";
        }

        if (empty($_POST["password"])) {
            $passwordValidationText = "Must enter a password";
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
</head>
<body>
<form action="login.php" method="post">
        <h2>Login</h2>

        <!-- Username textbox -->
        <label>Username: </label>
        <input type="text" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : ""; ?>">        
        <label><?php echo $usernameValidationText; ?></label><br><br>

        <!-- Password textbox -->
        <label>Password: </label>
        <input type="password" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "";?>">
        <label><?php echo $passwordValidationText; ?></label><br><br>
        
        <!-- Login-button -->
        <input type="submit" name="login" value="Log in"><br><br>
        <br>Don't have an account? <a href"register.php">Create account</a><br><br>
    </form>
</body>
</html>

<?php 
    

    include("footer.html");
?>