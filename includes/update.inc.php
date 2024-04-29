<?php


$email = '';
$pwd = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email =  $_POST['email'];
    $pwd = $_POST['pwd'];

    include_once '../classes/Dbh.php';
    include_once '../classes/UpdatePwdClass.php';
    include_once '../classes/UpdatePwdContrClass.php';

    $updateInstance = new UpdatePwdContrClass($email, $pwd);
    $updateInstance->updatePwd();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Form</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="container">
        <h2 class="h2Class">Update Information</h2>
        <form action='/includes/update.inc.php' method='post'>
            <div class="form-groupClass">
                <label class="labelClass">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-groupClass">
                <label class="labelClass">New password:</label>
                <input type="password" id="pwd" name="pwd" required>
            </div>

            <button class="updateButton" type="submit">Update</button>
            <a style="padding: 5px;" href='./login.inc.php'>⬅️Go Back</a>
        </form>
    </div>
</body>

</html>