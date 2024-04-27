<?php

session_start();

include_once '../classes/Dbh.php';
include_once '../classes/ProfileInfoClass.php';
include_once '../classes/ProfileInfoContrClass.php';
include_once '../classes/ProfileViewClass.php';

$result = new ProfileViewClass();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>

    <div class="profile-container">
        <a href="./home.inc.php">⬅️Go Back</a>
        <div class="profile-header">
            <h1>User Profile</h1>
            <p>Username: <?php echo $_SESSION['user_uid'] ?></p>
        </div>

        <div class="bio">
            <h2>About Me</h2>
            <p>Hi I am <?php echo $result->getAbout($_SESSION['user_id']) ?></p>
            <p>Title: <?php echo $result->getIntroTitle($_SESSION['user_id']) ?></p>
            <p>Intro: <?php echo $result->getIntroText($_SESSION['user_id']) ?></p>
            <div class='button-div'>
                <a href='./profile.inc.settings.php' class="button">Edit Profile</a>
            </div>
        </div>
    </div>

</body>

</html>