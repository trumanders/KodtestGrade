<?php
    session_start();
    include_once("database.php");
    include("header.php");

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

            // VALIDERA GILTIGT LÖSENORD

            $username = mysqli_real_escape_string($connection, $_POST['username']);
            $password = mysqli_real_escape_string($connection, $_POST['password']);

            // Check if username exists in database
            $checkUsernameQuery = "SELECT username FROM user WHERE username = ?";
            $stmt = $connection->prepare($checkUsernameQuery);
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows < 1) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // spara username + password i databasen
                $insertQuery = "INSERT INTO user (username, password) VALUES (?,?)";     
                $stmt = $connection->prepare($insertQuery);
                $stmt->bind_param("ss", $username, $hashed_password);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    $newUserId = $stmt->insert_id;
                    $userSelectQuery = "SELECT id, username FROM user WHERE id = ?";
                    $stmt = $connection->prepare($userSelectQuery);
                    $stmt->bind_param('s', $newUserId);
                    $stmt->execute();
                    $result = $stmt->get_result();            

                    // Create user object
                    if($result->num_rows > 0) {
                        $_SESSION['user'] = $result->fetch_assoc();
                        header("Location: confirmRegistration.php");
                        sleep(1);           
                        header("Location: home.php");
                    } else {
                        echo "Error fetching user information.";
                    }
                } 
            } else {
                $emailValidationBorderStyle = "border-color: red";
                $usernameValidationText = "Username already taken.";      
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