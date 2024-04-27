<?php

session_start();
include_once '../classes/Dbh.php';
include_once '../classes/ProfileInfoClass.php';
include_once '../classes/ProfileInfoContrClass.php';
require_once '../classes/ProfileViewClass.php';

$profileTitle = '';
$profileAbout = '';
$profileText = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $result = new ProfileViewClass();
    $profileTitle = $result->getIntroTitle($_SESSION['user_id']);
    $profileAbout = $result->getAbout($_SESSION['user_id']);
    $profileText = $result->getIntroText($_SESSION['user_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['user_id'];
    $uid = $_SESSION['user_uid'];

    $profileTitle = $_POST['profileTitle'] ?? null;
    $profileAbout = $_POST['profileAbout'] ?? null;
    $profileText = $_POST['profileText'] ?? null;

    if (empty($profileTitle) && empty($profileAbout) && empty($profileText)) {
        header('Location: ./profile.inc.settings.php?message=nodataprovided');
        exit();
    } else {
        $result = new ProfileInfoContrClass($userId, $uid);

        $update = $result->updateProfile(
            $profileAbout,
            $profileTitle,
            $profileText,
            $userId
        );
        header('Location: ./profile.inc.php?message=updateSuccessfully');
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="container">
        <a href="./profile.inc.php">⬅️Go Back</a>

        <h2>Profile Settings</h2>
        <form action="./profile.inc.settings.php" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="profileTitle" placeholder="Enter your title" value="<?php echo $profileTitle ?>">
            </div>
            <div class="form-group">
                <label for="about">About Me:</label>
                <textarea id="about" name="profileAbout" placeholder="Tell us about yourself"><?php echo $profileAbout ?></textarea>
            </div>
            <div class="form-group">
                <label for="intro">Intro Text:</label>
                <textarea id="about" name="profileText" placeholder="Enter your intro text"><?php echo $profileText ?></textarea>
            </div>
            <button class="buttonClass" type="submit">Update Profile</button>
        </form>
    </div>
</body>

</html>