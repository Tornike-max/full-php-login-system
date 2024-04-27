<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email =  $_POST['email'];
    $pwd =  $_POST['pwd'];

    if (empty($email) || empty($email)) {
        header('Location: ../index.php?message=error');
    }

    include_once '../classes/Dbh.php';
    include_once '../classes/LoginClass.php';
    include_once '../classes/LoginContrClass.php';

    $login = new LoginContrClass($pwd, $email);
    $login->loginuser();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="../styles/styles.css" ?>">
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form action="../includes/login.inc.php" method="post">
            <label for="username">Email:</label>
            <input type="text" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="pwd" id="pwd" name="pwd" required><br>

            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="signup.php">Signup here</a>.</p>
    </div>
</body>

</html>