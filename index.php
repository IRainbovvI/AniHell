<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Pizza-Hole</title>
</head>
<body>
    <div class="wrapper">
        <div class="banner">
            <div class="logo">
                <a href="./index.php"><img src="./images/logo.png" alt="logo"></a>
            </div>
            <div class="login">
                <?php
                    if (isset($_COOKIE['user'])) {
                        echo "<button>Sign Out</button>";
                    }else {
                        echo "<button>Register</button><button>Sign In</button>";
                    }
                ?>
            </div>
        </div> 
        <main>
            <div class="sidebar">
                    <a href="">Menu</a>
                    <?php
                        if (isset($_COOKIE['user'])) {
                            echo "<a href=''>Your Orders</a>";
                        }
                    ?>
                    <a href="">Contacts</a>
            </div>
            <div class="content">
                Pizza!
            </div>
        </main> 
    </div>
</body>
</html>