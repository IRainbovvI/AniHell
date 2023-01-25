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
                <a href="./users.php"><span>Users</span></a>
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
            <div class="entityContent">
                <?php
                $id = $_GET['id'];
                $type = $_GET['type'];
                $mysqli = new mysqli('localhost', 'root', '', 'anihell');
                ?>
                <?php
                if ($type == 'anime') {
                    $result = $mysqli->query("SELECT * FROM anime WHERE ID={$id}");
                    $row = $result->fetch_object();
                    $name = $row->MainTitle;
                    $animeAired = $row->Aired;
                    $animeEpisodes = $row->Episodes;
                    $animeSource = $row->Source;
                    $animeGenres = $row->Genres;
                    $animeRating = $row->Rating;
                    $description = $row->Description;
                    $imageURL = $row->ImageURL;
                } else if ($type == 'manga') {
                    $result = $mysqli->query("SELECT * FROM manga WHERE ID={$id}");
                    $row = $result->fetch_object();
                    $name = $row->MainTitle;
                    $mangaPublished = $row->Published;
                    $mangaChapters = $row->Chapters;
                    $mangaGenres = $row->Genres;
                    $description = $row->Description;
                    $imageURL = $row->ImageURL;
                } else {
                    $result = $mysqli->query("SELECT * FROM users WHERE ID={$id}");
                    $row = $result->fetch_object();
                    $name = $row->UserName;
                    $imageURL = $row->ImageURL;
                    $userJoined = $row->Joined;
                    $userGender = $row->Gender;
                    $description = $row->Bio;
                }
                echo "<h2>{$name}</h2>";

                ?>
                <div class="upperRow">
                    <?php
                    echo '<div class="description">';
                    echo '<p>' . $description . '</p>';
                    echo '</div>';
                    if ($type == 'anime') {
                        echo '<img src="' . $imageURL . '" >';
                    } else if ($type == 'manga') {
                        echo '<img src="' . $imageURL . '" >';
                    } else {
                        echo '<img src="../images/avatars/' . $imageURL . '.jpg" >';
                    }

                    ?>
                </div>
                <div class="lowerRow">
                    <?php
                    if ($type == 'anime') {
                        echo "<div class='likedByUsers'>";
                        echo "<h2>Liked By Users</h2>";
                        echo "<div class='listLiked'>";
                        $result = $mysqli->query("SELECT users.ID, users.UserName, users.ImageURL FROM `likedanime` INNER JOIN users ON likedanime.UserID=users.ID WHERE AnimeID={$id}");
                        if ($result->num_rows != 0) {
                            while ($row = $result->fetch_object()) {
                                echo '<a class="entityContainer" href="./entity.php?type=users&id=' . $row->ID . '">
                                <img src="' . "../images/avatars/" . $row->ImageURL . ".jpg" . '" alt="' . $row->UserName . '">
                                <span class="entityTitle">' . $row->UserName . '</span>
                            </a>';
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                    } else if ($type == 'manga') {
                        echo "<div class='likedByUsers'>";
                        echo "<h2>Liked By Users</h2>";
                        echo "<div class='listLiked'>";
                        $result = $mysqli->query("SELECT users.ID, users.UserName, users.ImageURL FROM `likedmanga` INNER JOIN users ON likedmanga.UserID=users.ID WHERE MangaID={$id}");
                        if ($result->num_rows != 0) {
                            while ($row = $result->fetch_object()) {
                                echo '<a class="entityContainer" href="./entity.php?type=users&id=' . $row->ID . '">
                                <img src="' . "../images/avatars/" . $row->ImageURL . ".jpg" . '" alt="' . $row->UserName . '">
                                <span class="entityTitle">' . $row->UserName . '</span>
                            </a>';
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='likedAnime'>";
                        echo "<h2>Liked Anime</h2>";
                        echo "<div class='listLiked'>";
                        $result = $mysqli->query("SELECT anime.ID, anime.MainTitle, anime.ImageURL FROM `likedanime` INNER JOIN anime ON likedanime.AnimeID=anime.ID WHERE UserID={$id}");
                        if ($result->num_rows != 0) {
                            while ($row = $result->fetch_object()) {
                                echo '<a class="entityContainer" href="./entity.php?type=anime&id=' . $row->ID . '">
                                <img src="' . $row->ImageURL . '" alt="' . $row->MainTitle . '">
                                <span class="entityTitle">' . $row->MainTitle . '</span>
                            </a>';
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='likedManga'>";
                        echo "<h2>Liked Manga</h2>";
                        echo "<div class='listLiked'>";
                        $result = $mysqli->query("SELECT manga.ID, manga.MainTitle, manga.ImageURL FROM `likedmanga` INNER JOIN manga ON likedmanga.MangaID=manga.ID WHERE UserID={$id}");
                        if ($result->num_rows != 0) {
                            while ($row = $result->fetch_object()) {
                                echo '<a class="entityContainer" href="./entity.php?type=manga&id=' . $row->ID . '">
                                <img src="' . $row->ImageURL . '" alt="' . $row->MainTitle . '">
                                <span class="entityTitle">' . $row->MainTitle . '</span>
                            </a>';
                            }
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                    <div class="info">
                        <h2>Info</h2>
                        <?php
                        if ($type == 'anime') {
                            echo "<p>Title: {$name}</p>";
                            echo "<p>Aired: {$animeAired}</p>";
                            echo "<p>Episodes: {$animeEpisodes}</p>";
                            echo "<p>Source: {$animeSource}</p>";
                            echo "<p>Genres: {$animeGenres}</p>";
                        } else if ($type == 'manga') {
                            echo "<p>Title: {$name}</p>";
                            echo "<p>Published: {$mangaPublished}</p>";
                            echo "<p>Chapters: {$mangaChapters}</p>";
                            echo "<p>Genres: {$mangaGenres}</p>";
                        } else {
                            echo "<p>Username: {$name}</p>";
                            echo "<p>Joined: {$userJoined}</p>";
                            echo "<p>Gender: {$userGender}</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>