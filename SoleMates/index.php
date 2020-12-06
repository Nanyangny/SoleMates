<?php

require("./php/database.php");
require("./php/functions.php");
$db = db_connect();
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sole Mates</title>
    <link rel="stylesheet" href="./styles/main.css">
</head>

<body>
    <header>
        <div class='header-container'>
            <div class='logo'><a href="index.php"><img src="./images/Logo.png" width="172" height="80" /></a></div>
            <div class="searchbar-container">
            <form action="./shopping.php?" method="get">
                <div class="searchbar-main">
                    <button class="search-input-icon"><svg fill="#111" height="25px" width="25px" viewBox="0 0 24 24">
                            <path d="M21.71 20.29L18 16.61A9 9 0 1 0 16.61 18l3.68 3.68a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.39zM11 18a7 7 0 1 1 7-7 7 7 0 0 1-7 7z"></path>
                        </svg></button>
                        
                    <input type="text" value="" name="search" maxlength="128" placeholder="Search your favourite shoes!">
                   
                </div>
                </form>
            </div>
            <div class='topicons'>

                <?php
                if (isset($_SESSION['valid_user'])) {
                    if($_SESSION['valid_user']=='admin'){
                        echo "<a href='./admin.php'>Admin</a> | <a href='logout.php'>Logout </a>";
                    }
                    else{
                        echo "Welcome ". $_SESSION['valid_user'] . " | <a href='logout.php'>Logout </a>";
                    }
                    echo "|<a href='shoppingcart.php' class='notif'><img src='./images/cart_num.png' height='30px' width='30px'>";
                    if (isset($_SESSION['num_cart']) == false) {
                        $_SESSION['num_cart'] = 0;
                    }
                    echo "<span class='num'>" . $_SESSION['num_cart'] . "</span></a>";
                    // echo "</a>";
                } else {
                    echo "<a href='Registration.php'>Sign Up </a> | <a href='login.php'>Login </a>";
                }
                ?>
            </div>
        </div>
    </header>

    <div class="wrapper">

        <div class="feature_product">
            <div class="main-feature">
                <a href="shopping.php"><img src="./images/main.gif"></a>
                <div class="main-feature-text">
                    <h1>Define COMFORT in a new way</h1>
                    <span>Solomates knows you the best from the very bottom.</span>
                </div>
            </div>

        </div>
        <div class="heading-category">
            <div class="heading-title"><a href="shopping.php">
                    <h2>Categories</h2>
                </a></div>
            <div class="heading-row" id="category">
                <a href="./shopping.php?type=0"><img src="./images/running.jpg"></a>
                <a href="./shopping.php?type=2"><img src="./images/tennis.jpg"></a>
                <a href="./shopping.php?type=1"><img src="./images/basketball.jpg"></a>
                <a href="./shopping.php?type=3"><img src="./images/golf.jpg"></a>
            </div>


        </div>
        <hr>
        <div class="heading-category">
            <div class="heading-title"><a href="">
                    <h2>Popular CHOICES</h2>
                </a></div>
            <div class="heading-row" style="position:relative;" id="top_seller">
                <?php
                $res = gettopseller();

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<a href='./product.php?id=" . $row['id'] . "'><img style='position:absolute;' src='./images/best_seller.png'><img c src='./products" . $row['img_path'] . "'></a>";

                }

                ?>
            </div>
        </div>


        <?php require("./template/footer.php") ?>