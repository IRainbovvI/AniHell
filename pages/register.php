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
            <div class="registerContainer">
                <h2>Register</h2>
                <?php
                if (isset($_REQUEST["submit"])) {
                    $password = $_POST["password"];
                    if (!preg_match('@[A-Z]@', $password) || !preg_match('@[a-z]@', $password) || !preg_match('@[0-9]@', $password) || !preg_match('@[^\w]@', $password) || strlen($password) < 8) {
                        echo "<p class='error'>Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.</p>";
                    } else {
                        $mysqli = new mysqli('localhost', 'root', '', 'anihell');
                        $username = $_POST['username'];
                        $password = hash("sha256", $password);
                        $avatar = isset($_POST['avatar']) ? $_POST['avatar'] : 0;
                        $joined = date('Y-m-d');
                        $gender = $_POST['gender'];
                        $bio = isset($_POST['bio']) ? $_POST['bio'] : "";
                        $result = $mysqli->query("SELECT * FROM users WHERE `UserName` LIKE '{$username}'");
                        if ($result->num_rows != 0) {
                            echo "<p class='error'>Username is already taken.</p>";
                        } else {
                            $mysqli->query("INSERT INTO `users` VALUES (NULL, '{$username}', '{$password}', '{$avatar}', '{$joined}', '{$gender}', '{$bio}')");
                            $mysqli->close();
                            $_SESSION['username'] = $username;
                            header("Location: http://localhost/PHP/AniHell/index.php");
                        }

                    }
                }
                ?>
                <form method="post">
                    <h3>Avatar</h3>
                    <div class="avatars">
                        <?php
                        foreach (new DirectoryIterator('../images/avatars') as $file) {
                            if ($file->isFile()) {
                                $fileName = $file->getBasename(".jpg");
                                $filePath = $file->getPath();
                                if ($fileName != '0') {
                                    echo "<label>
                                <input type='radio' name='avatar' value='{$fileName}'>
                                <img src='{$filePath}/{$file}' alt='{$fileName}'/>
                                </label>";
                                }
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <h3>User Name</h3>
                        <input type="text" name="username" minlength="5" maxlength="15" required>
                    </div>
                    <div>
                        <h3>Password</h3>
                        <input type="password" name="password" minlength="8" autocomplete="new-password" required>
                    </div>
                    <div>
                        <h3>Gender</h3>
                        <select name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Non-binary">Non-binary</option>
                            <option value="Unknown">Unknown</option>
                        </select>
                    </div>
                    <div>
                        <h3>Bio</h3>
                        <textarea name="bio"></textarea>
                    </div>
                    <button type="submit" name="submit">Sign Up</button>
                </form>
            </div>
        </main>
    </div>
</body>

</html>