<?php
    session_start();
    include('header.php');

    if (isset($_GET['id']) && isset($_SESSION['allUserDiaryEntries']) && !empty($_SESSION['allUserDiaryEntries'])) {
        $diaryEntryId = intval($_GET['id']);
        $diaryEntrySubject;
        $diaryEntryDate;
        $diaryEntryText;
                
        foreach ($_SESSION['allUserDiaryEntries'] as $entry) {
            if ($entry['id'] == $diaryEntryId) {
                $diaryEntrySubject = $entry['diary_entry_subject'];
                $diaryEntryDate = $entry['diary_entry_date'];
                $diaryEntryText = $entry['diary_entry_text'];
                break;
            }
        }
    } else {
        header('Location: home.php');
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="view-diary-entry">
        <h3><?php echo $diaryEntrySubject; ?></h3>
        <h5><?php echo $diaryEntryDate; ?></h5>
        <h4><?php echo $diaryEntryText; ?></h4>
    </div>
</body>
</html>