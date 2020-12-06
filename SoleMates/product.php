<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sole Mates - Shoes</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/product.css">
    <!-- can add additional css to this html -->
</head>
<?php
require("./template/header.php");
// session_destroy();
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
    $_SESSION['size'] = array();
    $_SESSION['qty'] = array();
}
if (isset($_GET['qty']) & isset($_GET['size'])) {
    $update = $_GET['id'] . "_" . $_GET['size'] . "|" . $_GET['qty'];
    groupCart($update);
    // back to the same page to update the shopping cart 
    header("location:".$_SERVER['PHP_SELF']."?id=".$_GET['id']);
}



if (isset($_GET['id'])) {
    $result = get_product_by_id($_GET['id']);
    $product = mysqli_fetch_array($result);
}


// var_dump($_SESSION);

// check login status
$login = isset($_SESSION['valid_user']);

$stock = checkstock($_GET['id']);
$avail_size_num = mysqli_num_rows($stock);
$avail_stock = Array();
while($row = mysqli_fetch_assoc($stock)){
    $avail_stock[strval($row['size'])]=intval($row['qty']); // convert string to int 
}
?>




<!-- your webpage content here -->
<div class="wrapper">
    <!-- <div>Product page here</div> -->
    
    <?php
    echo "<div class='left_product_img'>";
    echo "<img src='./products" . $product['img_path'] . "' width='300'></div>";
    echo "<div class='product_option'>";

    // get gender
    if ($product['gender'] == 'F') {
        $gender = "Women's ";
    } else {
        $gender = "Men's ";
    }
    echo "<span>" . $gender . $product['type'] . "</span>";
    // <!-- display product name  -->
    echo "<h2>" . $product['name'] . "</h2>";

    // <!-- display price -->
    echo "<h2>$" . $product['price'] . "</h2>";
    ?>


    <hr align="left">

    <div class='quantity'>


    </div>
    <br>
    <div class="section_name">Size</div>
    <br>

    <div class="btn_group">
        <?php 
        $size = Array(7,7.5,8,8.5,9,9.5,10,10.5,11,11.5,12);
        for($i=0; $i<count($size);$i++){
            echo "<div>";
            if(array_key_exists(strval($size[$i]), $avail_stock)){
                echo "<input type='hidden' value='".$avail_stock[strval($size[$i])]."'>";
                echo "<input name='size' id='".$size[$i]."' type='radio' class='size_radio' value='".$size[$i]."' onclick='checkStock(this)'>";
                
            }
            else{
                echo "<input name='size' id='".$size[$i]."' type='radio' class='size_radio' value='".$size[$i]."' disabled>";
            }
            echo "<label for='".$size[$i]."' class='size_label'>US ".$size[$i]."</label> </div>";
        }
        ?>

    </div>
    <br>
    <div class="section_name">Quantity</div>
    <br>
    <input type="number" name="qty" value="1" min="1" max="1" style="font-size: 18px;">

    <div>
        <input type="submit" name="addcart" value="Add to chart" onclick="<?php echo "addToCart(" . $product['id'] .",".$login.");"; ?>">
       <small> Stock Available:</small> <span id='stock_num'>0</span>
    </div>
    <br>
    <div class='validation' ></div>

<!-- The Modal -->
<div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <!-- Modal Content -->
    <div class="modal-content animate">
        <div class="container" style="text-align:center;">
            Please log in to add.
        </div>
        <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="document.getElementById('id01').style.display='none'" class="popup">Cancel</button>
            <button type="button" onclick="window.location.href='./login.php?product_id=<?php echo $_GET['id'] ?>'" class="popup">Login</button>
        </div>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</div>
    
</div>




<script src="./javascript/shopping.js"></script>

    </div>

<?php require("./template/footer.php") ?>