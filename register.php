<?php
    session_start();
    include_once("database.php");
    include("header.php");

    $emailValidationBorderStyle = "";
    $passwordValidationBorderStyle = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {

        if (empty($_POST["username"])) {
            $emailValidationBorderStyle = "border-color: red;";
        }

        if (empty($_POST["password"])) {
            $passwordValidationBorderStyle = "border-color: red;";
        }

        if (!empty($_POST["username"]) && !empty($_POST["password"])) {

            // VALIDERA email-regex

            // VALIDERA GILTIGT LÖSENORD

            $username = mysqli_real_escape_string($connection, $_POST["username"]);
            $password = mysqli_real_escape_string($connection, $_POST["password"]);

            //$hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // spara username + password i databasen
            $sqlQuery = "INSERT INTO user (username, password) VALUES ('$username', '$password')";            
            $result = mysqli_query($connection, $sqlQuery);            

            // TODO: Kolla om registreringen lyckdes innan fortsätta:
            $_SESSION["isLoggedIn"] = true;
            $_SESSION["username"] = $username;
            header("Location: confirmRegistration.php");
            sleep(1);           

            // om man är inloggad tas man till home, annars login
            header("Location: index.php");
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
    <h2>Sign up</h2>
    <form action="register.php" method="post">
        <input
            type="text"
            name="username"
            placeholder="email"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'email', <?php echo isset($_POST["register"]) ? 'true' : 'false'; ?>)"
            style="<?php echo $emailValidationBorderStyle; ?>"
            value="<?php echo isset($_POST["username"]) ? $_POST["registerEmail"] : ""; ?>">
        <br><br>
        <input
            type="password"
            name="password"
            placeholder="password"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'password', <?php echo isset($_POST["register"]) ? 'true' : 'false'; ?>)"
            style="<?php echo $passwordValidationBorderStyle; ?>"
            value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "";?>">
        <br><br>
        <input type="submit" name="register" value="Sign up"><br><br>
    </form>
</body>
</html>

<?php

?>