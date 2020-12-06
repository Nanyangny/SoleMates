<?php

require("./php/database.php");
require("./php/functions.php");
$db = db_connect();
session_start();

?>

<body>
    <header>
        <div class='header-container'>
            <div class='logo'><a href="index.php"><img src="./images/Logo.png" width="172" height="80" /></a></div>
            <div class='navbar'>
            <a href="index.php">Home</a>
                <div class="dropdown">
                    <a href="shopping.php">Shoes</a>
                    <div class="dropdown-content">
                    <a href="./shopping.php?type=0">Running</a>
                    <a href="./shopping.php?type=2">Tennis</a>
                    <a href="./shopping.php?type=1">Basketball</a>
                    <a href="./shopping.php?type=3">Golf</a>
                    </div>
                </div>
                <div class="dropdown">
                <a href="contact.php">Help</a>
                    <div class="dropdown-content">
                        <a href="./contact.php">FAQ</a>
                        <a href="./contact.php#contact_us">Contact Us</a>
                    </div>
                </div>
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