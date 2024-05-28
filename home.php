<?php    
    session_start();
    include('database.php');
    include("header.php");
    
    if (isset($_SESSION['user'])) {
        $userId = $_SESSION['user']['id'];
        $username = $_SESSION['user']['username'];
        $query = "SELECT id, diary_entry_date, diary_entry_subject, diary_entry_text FROM diary_entry WHERE user_id = ?";
        $stmt = $connection->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $_SESSION['allUserDiaryEntries'] = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        header('Location: index.php');
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
    <a href="editDiaryEntry.php"><h2> Add diary entry</h2></a>   
    Your diary entries<br>
    <?php 
        foreach ($_SESSION['allUserDiaryEntries'] as $diaryEntry) {
            echo "<a href='viewDiaryEntry.php?id=" . htmlspecialchars($diaryEntry['id']) . "'>" . htmlspecialchars($diaryEntry['diary_entry_date']) . "</a><br>";
        }
    ?>    
</body>
</html>

<?php
    include("footer.html");
?>