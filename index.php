<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./index.css">
    <title>AniHell</title>
</head>
<body>
    <div class="wrapper">
        <div class="banner">
                <a class='logoSquare' href="./index.php"><img src="./images/logo.png" alt="AniHell"></a>
                <div class="menu">
                    <a href=""><span>Anime</span></a>
                    <a href=""><span>Manga</span></a>
                    <a href=""><span>Users</span></a>
                    <?php
                        if(isset($_COOKIE['user'])){
                            echo '<a href=""><span>Sign Out</span></a>';
                        }else{
                            echo '<a href=""><span>Profile</span></a>'; 
                            echo '<a href=""><span>Sign In</span></a>';
                        }
                    ?>
                </div>
        </div>
    </div>
</body>
</html>