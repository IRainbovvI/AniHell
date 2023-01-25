<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <title>AniHell</title>
</head>

<body>
    <div class="wrapper">
        <div class="banner">
            <a class='logoSquare' href="../index.php"><img src="../images/logo.png" alt="AniHell"></a>
            <div class="menu">
                <a href="../index.php"><span>Anime</span></a>
                <a href="./manga.php"><span>Manga</span></a>
                <a href=""><span>Users</span></a>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<a href=""><span>Profile</span></a>';
                    echo '<a href="./signout.php"><span>Sign Out</span></a>';
                } else {
                    echo '<a href="./register.php"><span>Sign Up</span></a>';
                    echo '<a href="./signin.php"><span>Sign In</span></a>';
                }
                ?>
            </div>
        </div>
        <main>
            <div class="loginContainer">
                <h2>Log In</h2>
                <?php
                if (isset($_REQUEST['submit'])) {
                    $password = hash('sha256', $_POST['password']);
                    $username = $_POST['username'];
                    $mysqli = new mysqli('localhost', 'root', '', 'anihell');
                    $result = $mysqli->query("SELECT `UserName` FROM users WHERE `UserName` LIKE '{$username}' AND `Password` LIKE '{$password}'");
                    if ($result->num_rows != 0) {
                        $_SESSION['username'] = $username;
                        header("Location: http://localhost/PHP/AniHell/index.php");
                    } else {
                        echo "<p class='error'>Wrong credentials.</p>";
                    }
                }
                ?>
                <form method="POST">
                    <h3>Username</h3>
                    <input type="text" name="username" required>
                    <h3>Password</h3>
                    <input type="password" name="password" required>
                    <button type="submit" name="submit">Sign In</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>