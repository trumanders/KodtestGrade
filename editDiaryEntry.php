<?php
    session_start();
    include('header.php');
    include('database.php');
    $diaryEntry = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
        if (!empty($_POST["diaryEntryDate"]) && !empty($_POST["diaryEntryText"])) {
            $diaryEntryText = mysqli_real_escape_string($connection, $_POST["diaryEntryText"]);
            $diaryEntrySubject = mysqli_real_escape_string($connection, $_POST["diaryEntrySubject"]);
            $diaryEntryDate = mysqli_real_escape_string($connection, $_POST["diaryEntryDate"]);
            $userId = $_SESSION['user']['user_id'];
            $sqlQuery = "INSERT INTO diary_entry (user_id, diary_entry) VALUES ('$userId', '$diaryEntryText')";
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
        $todaysDate = date("Y-m-d");
    ?>

    <form action="editDiaryEntry.php" method="post">
        <input type="text" name="diaryEntryDate" placeholder="date" value="<?php echo $todaysDate; ?>"/><br><br>
        <input type="text" name="diaryEntrySubject" placeholder="diary subject"/><br><br>
    
        <textarea name="diaryEntryText" placeholder="enter your diary text here..." rows="10" cols="50"></textarea><br>
        <input type="submit" name="submit" value="Save">
    </form>
</body>
</html>