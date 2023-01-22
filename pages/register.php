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
                if (isset($_COOKIE['user'])) {
                    echo '<a href=""><span>Profile</span></a>';
                    echo '<a href=""><span>Sign Out</span></a>';

                } else {
                    echo '<a href="./register.php"><span>Sign Up</span></a>';
                    echo '<a href=""><span>Sign In</span></a>';
                }
                ?>
            </div>
        </div>
        <main>
            <div class="registerContainer">
                <h2>Register</h2>
                <form action="">
                    <h3>Avatar</h3>
                    <div class="avatars">
                        <?php
                        foreach (new DirectoryIterator('../images/avatars') as $file) {
                            if ($file->isFile()) {
                                $fileName = $file->getBasename(".jpg");
                                $filePath = $file->getPath();
                                echo "<label for='{$fileName}'>
                                <input type='radio' id='{$fileName}' name='avatar' value='{$fileName}'>
                                <img src='{$filePath}/{$file}' alt='{$fileName}'/>
                                </label>";
                            }
                        }
                        ?>
                    </div>
                    <div class="username">
                        <h3>User Name</h3>
                        <input type="text" id="username" required>
                    </div>


                </form>
            </div>

        </main>

    </div>
</body>

</html>