<?php
    session_start();
    include('header.php');
    include('database.php');
    $currentDateTime = date("Y-m-d H:i:s");
    $diaryEntry = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        if (!empty($_POST["diaryEntryDate"]) && !empty($_POST["diaryEntryText"])) {
            $diaryEntryText = mysqli_real_escape_string($connection, $_POST["diaryEntryText"]);
            $diaryEntrySubject = mysqli_real_escape_string($connection, $_POST["diaryEntrySubject"]);
            $diaryEntryDate = mysqli_real_escape_string($connection, $_POST["diaryEntryDate"]);
            $userId = $_SESSION['user']['id'];
            $sqlQuery = "INSERT INTO diary_entry (user_id, diary_entry_date, diary_entry_subject, diary_entry_text) VALUES ('$userId', '$diaryEntryDate','$diaryEntrySubject','$diaryEntryText')";
            $result = mysqli_query($connection, $sqlQuery);

            if ($result) {
                echo "Diary entry added.";
            } else {
                "Error: " . mysqli_error($connection);
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
</head>
<body>
    <?php
        
    ?>

    <form action="editDiaryEntry.php" method="post">
        <input type="text" name="diaryEntryDate" placeholder="date" value="<?php echo $currentDateTime; ?>"/><br><br>
        <input type="text" name="diaryEntrySubject" placeholder="diary subject"/><br><br>
    
        <textarea name="diaryEntryText" placeholder="enter your diary text here..." rows="10" cols="50"></textarea><br>
        <input type="submit" name="submit" value="Save">
    </form>
</body>
</html>