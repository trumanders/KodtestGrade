<?php
    include('database.php');
    function isUserExists($username) {   
        global $connection;   
        $checkUsernameQuery = "SELECT username FROM user WHERE username = ?";
        $stmt = $connection->prepare($checkUsernameQuery);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    function insertUser($username, $password) {
        global $connection;
        $result = '';
        $insertQuery = "INSERT INTO user (username, password) VALUES (?,?)";     
        $stmt = $connection->prepare($insertQuery);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $newUserId = $stmt->insert_id;
            $userSelectQuery = "SELECT id, username FROM user WHERE id = ?";
            $stmt = $connection->prepare($userSelectQuery);
            $stmt->bind_param('s', $newUserId);
            $stmt->execute();
            $result = $stmt->get_result();
        }
        return $result;
    }
?>