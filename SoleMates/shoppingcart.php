<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sole Mates - Cart</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/cart.css">

    <!-- can add additional css to this html -->
</head>
    
<?php require("./template/header.php"); ?>

<div class="wrapper">
    <?php

    if(isset($_SESSION['valid_user'])==False){
        echo "<div class=\"notfound\" style='padding-top:10%; width:50%; margin:auto;'><hr><br>";
        echo "You have not logged in, please login!";
        echo "<br><br><hr></div>";
    }


    else if (count($_SESSION['cart']) == 0) {
        echo "<div class=\"notfound\" style='padding-top:10%; width:50%; margin:auto;'><hr><br>";
        echo "<a href='./shopping.php'>Your cart is empty, please find your solemates!</a>";
        echo "<br><br><hr></div>";
        $_SESSION['num_cart']=count($_SESSION['cart']);
    } else {

        if (isset($_GET['update']) & isset($_GET['buy'])) {
            updateCartQty($_GET['update']);
            header("location:" . "./confirmation.php?buy=" . $_GET['buy']);
        } else if (isset($_GET['delete'])) {
            deleteCartRow($_GET['delete']);
            $_SESSION['num_cart']=count($_SESSION['cart']);
            header("location:" . "./shoppingcart.php");
        }
        echo "<table onchange='calculateTotalAmount();' oninput='removeValidationInfo();'><thead>";
        echo "<td><input type=\"checkbox\" id=\"all\" onchange='toggleAll();'></td>";
        echo "<th>Shoes</th><th>Name</th><th>Size</th><th>Prize</th><th>Quantity</th></thead>";


        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            $id_size = array_keys($_SESSION['cart'])[$i];
            echo "<tbody>";
            $result = get_product_by_id_size($_SESSION['cart'][$id_size],$_SESSION['size'][$id_size]);
            $product = mysqli_fetch_assoc($result);
            echo "<input type='hidden' name='id_size' value=" . $id_size . " >";
            showShoppingCartRow($product['price'], $_SESSION['qty'][$id_size], $_SESSION['size'][$id_size], $product['img_path'], $product['qty'], $product['name']);
        }
        echo "</tbody>";

        echo "<tfoot>";
        echo "<tr>";
        echo "<td colspan='3'></td>";
        echo "<td colspan='2'><strong> Total Amount</strong></td>";
        echo "<td id='totalAmount'>$0</td>";
        echo "</tr>";
        echo "<tr >";
        echo "<td colspan='3'></td>";
        echo "<td colspan='1'><button onclick='removeFromCart()'>Remove</button></td>";
        echo "<td colspan='2'><button onclick='validateCheckout()'>Checkout (<span name='selected_item'>0</span>)</button></td>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        echo "<div class='validation' ></div>";
    }


    ?>


<script src='./javascript/shopping.js'></script>
</div>




<?php require("./template/footer.php") ?>