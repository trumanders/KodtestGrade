<?php
    // hantera spara dagboksinlägg på sparaknappen
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
        <label for="standardText">Date: </label>
        <input type="text" name="diaryEntryDate" value="<?php echo $todaysDate; ?>"/><br><br>
    
        <textarea id="largeText" name="largeText" rows="10" cols="50"></textarea><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>