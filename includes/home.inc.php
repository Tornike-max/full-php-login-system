<?php
session_start();

$email = $_SESSION["user_email"];
$uid = $_SESSION['user_uid'];

if (empty($email) || empty($uid)) {
    header('Location: ./signup.inc.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo 'hello';

    session_unset();
    session_destroy();
    header('Location: ./signup.inc.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Homepage</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f0f0;
            color: #333;
        }

        .header {
            background-color: #004578;
            color: #ffffff;
            text-align: center;
            padding: 20px 20px;
            position: relative;
            font-size: 24px;
        }

        .header .logout {
            position: absolute;
            right: 20px;
            top: 20px;
            padding: 10px 20px;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .header .profile {
            position: absolute;
            right: 120px;
            top: 20px;
            padding: 9px 20px;
            background: #f44336;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;

        }

        .content {
            padding: 40px 20px;
            text-align: center;
            background: #ffffff;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .content img {
            width: 80%;
            max-width: 600px;
            height: auto;
            border-radius: 8px;
            margin-top: 20px;
        }

        h1 {
            color: #ffffff;
        }

        h2 {
            color: #333;
        }

        p {
            color: #666;
        }

        span {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Welcome to Your Homepage</h1>
        <div>
            <span><?php echo $uid ?></span>
        </div>
        <span><?php echo $email ?></span>

        <form style="display: flex" method='post' action="./home.inc.php">
            <button type="submit" class="logout" onclick="alert('Logging out!');">Logout</button>
            <a href='/includes/profile.inc.php' class='profile'>Profile</a>
        </form>

    </div>
    <div class="content">
        <h2>Explore Our Features</h2>
        <p>Discover the unique aspects of our website by browsing through various sections and learning more about what we offer.</p>
        <img src="../image/me.png" alt="Placeholder Image">
    </div>
</body>

</html>