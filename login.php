<?php
    session_start();
    include("header.php");
    include("database.php");

    $wrongUsernameOrPassword = "";
    $emailValidationBorderStyle = "";
    $passwordValidationBorderStyle = "";

    if (isset($_SESSION['user'])) {
        header('Location: home.php');
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login'])) {        
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($username)) {
            $emailValidationBorderStyle = "border-color: red;";
        }

        if (empty($password)) {
            $passwordValidationBorderStyle = "border-color: red;";
        }

        if (!empty($username) && !empty($password)) {   
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);     
    
            // validera användarnamn / login
            $query = "SELECT id, username, password FROM user WHERE username = ?";
            $stmt = $connection->prepare($query);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
    
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    header("Location: home.php");
                    exit();
                } else {
                    $wrongUsernameOrPassword = "Wrong username or password";
                }            
            } else {
                $wrongUsernameOrPassword = "Wrong username or password";
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
    <h2>Login</h2>
    <form action="login.php" method="post">
        <input
            type="text"
            name="username"
            placeholder="email"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'email', <?php echo isset($_POST['login']) ? 'true' : 'false'; ?>)"
            style="<?php echo $emailValidationBorderStyle; ?>"
            value="<?php echo isset($_POST['username']) ? $_POST['username'] : ""; ?>">
        <br><br>

        <input
            type="password"
            name="password"
            placeholder="password"
            onfocus="clearPlaceholderAndBorderStyle(this)"
            onblur="resetPlaceholderAndBorderStyle(this, 'password', <?php echo isset($_POST['login']) ? 'true' : 'false'; ?>)"
            style="<?php echo $passwordValidationBorderStyle; ?>"
            value="<?php echo isset($_POST['password']) ? $_POST['password'] : "";?>">
        <br><br>
        <input type="submit" name="login" value="Log in">
        <?php echo "<span style='color: red;'>$wrongUsernameOrPassword</span>"; ?><br><br>
        <br>Don't have an account? <a href="register.php">Create new accout</a><br><br>
    </form>
</body>
</html>

<?php


    include("footer.html");
?>