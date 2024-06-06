<?php
    session_start();
    include_once('database.php');
    include('header.php');
    include('functions.php');

    if (isset($_SESSION['user'])) {
        header('Location: home.php');
        exit();
    }

    $emailValidationBorderStyle = "";
    $passwordValidationBorderStyle = "";
    $usernameValidationText = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['register'])) {

        if (empty($_POST['username'])) {
            $emailValidationBorderStyle = "border-color: red;";
        }

        if (empty($_POST['password'])) {
            $passwordValidationBorderStyle = "border-color: red;";
        }

        if (!empty($_POST['username']) && !empty($_POST['password'])) {

            // VALIDERA email-regex

            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);            

            if (isUserExists($username)) {
                $emailValidationBorderStyle = "border-color: red";
                $usernameValidationText = "Username already taken."; 
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                $userResult = insertUser($username, $hashed_password);                           

                // Create user object
                if($userResult->num_rows > 0) {
                    $_SESSION['user'] = $userResult->fetch_assoc();
                    header("Location: confirmRegistration.php");
                    sleep(1);           
                    header("Location: home.php");
                } else {
                    echo "Error fetching user information.";
                }
            } 
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
            onblur="resetPlaceholderAndBorderStyle(this, 'email', <?php echo isset($_POST['register']) ? 'true' : 'false'; ?>)"
            style="<?php echo $emailValidationBorderStyle; ?>"
            value="<?php echo isset($_POST['username']) ? $_POST['username'] : ""; ?>">
            <span class="validation-error">
                <?php echo $usernameValidationText; ?>
            </span>
        <br><br>
        <input
            type="password"
            name="password"
            placeholder="password"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'password', <?php echo isset($_POST['register']) ? 'true' : 'false'; ?>)"
            style="<?php echo $passwordValidationBorderStyle; ?>"
            value="<?php echo isset($_POST['password']) ? $_POST['password'] : "";?>">
        <br><br>
        <input type="submit" name="register" value="Sign up"><br><br>
    </form>
</body>
</html>