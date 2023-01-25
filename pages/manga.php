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
        <form class="searchSquare" method="GET">
            <div class="searchBar">
                <input type="text" name="search" id="search" placeholder="Enter the name...">
            </div>
            <button class="searchButton" type="submit"><span>Search</span></button>
        </form>
        <main>
            <div class="content">
                <?php
                $mysqli = new mysqli('localhost', 'root', '', 'anihell');
                if (isset($_REQUEST['search']) && $_REQUEST['search'] != "") {
                    $result = $mysqli->query("SELECT * FROM manga WHERE MainTitle LIKE '%" . $mysqli->real_escape_string($_REQUEST['search']) . "%'");

                } else if (isset($_REQUEST['genre']) && $_REQUEST['genre'] != "") {
                    $result = $mysqli->query("SELECT * FROM manga WHERE Genres LIKE '%" . $mysqli->real_escape_string($_REQUEST['genre']) . "%'");
                } else {
                    $result = $mysqli->query("SELECT * FROM manga");

                }
                if ($result->num_rows != 0) {
                    while ($row = $result->fetch_object()) {
                        echo '<a class="animeContainer" href="">
                                <img src="' . $row->ImageURL . '" alt="' . $row->MainTitle . '">
                                <span class="animeTitle">' . $row->MainTitle . '</span>
                            </a>';
                    }
                }

                $mysqli->close();
                ?>
            </div>
            <form method="get" class="genres">
                <span>Genres:</span>
                <div class="genresContainer">
                    <?php
                    $mysqli = new mysqli('localhost', 'root', '', 'anihell');
                    $result = $mysqli->query("SELECT DISTINCT Genres FROM `manga`");
                    if ($result->num_rows != 0) {
                        $genres = '';
                        while ($row = $result->fetch_object()) {
                            $genres .= $row->Genres . " ";
                        }
                        $genres = array_unique(explode(" ", trim($genres)));
                        foreach ($genres as $genre) {
                            echo '<button type="submit" name="genre" id="genre" value="' . $genre . '" class="genre">
                            ' . $genre . '
                            </button>';
                        }
                    }
                    ?>
                </div>
            </form>
        </main>

    </div>
</body>

</html>