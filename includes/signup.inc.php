<?php




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];

    include_once '../classes/Dbh.php';
    include_once '../classes/SignupClass.php';
    include_once '../classes/SignupContrClass.php';





    $signup = new SignupContrClass($uid, $pwd, $pwdrepeat, $email);

    $signup->signupuser();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>

<body>
    <div class="container">
        <h2>Signup</h2>
        <form action="../includes/signup.inc.php" method="post">
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required><br>

            <label for="username">Username:</label>
            <input type="text" id="username" name="uid" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="pwd" required><br>

            <label for="password">Repeat Password:</label>
            <input type="password" id="password" name="pwdrepeat" required><br>
            <button type='submit'>Signup</button>
        </form>
        <p>Already have an account? <a href="../includes/login.inc.php">Login here</a>.</p>
    </div>
</body>

</html>