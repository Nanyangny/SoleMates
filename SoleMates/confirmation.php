<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Sole Mates - Confirmation</title>
    <link rel="stylesheet" href="./styles/main.css">
    <link rel="stylesheet" href="./styles/confirmation.css">
    <!-- can add additional css to this html -->
</head>
<?php require("./template/header.php");

if (isset($_GET['buy'])) {
    $_SESSION['selected'] = explode(",", $_GET['buy']);
    $_SESSION['num_cart'] = count($_SESSION['cart']);
    $_SESSION['price'] = array();
    header("location:" . "./confirmation.php");
}

$address = get_address_by_name($_SESSION['valid_user']);
$creditcard = get_cc_by_name($_SESSION['valid_user']);
$user_id = get_user_id_by_name($_SESSION['valid_user']);


if (is_post_request()) {


    if (isset($_POST['address'])) {
        if ($_POST['address'] != $address) {
            update_user_address($user_id, $_POST['address']);
        }
    }
    if (isset($_POST['credit_card'])) {
        if ($_POST['credit_card'] != $creditcard) {
            update_user_cc($user_id, $_POST['credit_card']);
        }
    }
    update_order($user_id);
    header("location:" . "./confirmation.php?redirect=1");
}


?>


<!-- your webpage content here -->
<div class="wrapper">
    
    <div class="cust_order"><span><?php echo $_SESSION['valid_user'] . "'s order" ?></span></div>
    <table>
        <thead>
            <th>Item</th>
            <th>Shoes</th>
            <th>Size</th>
            <th>Price($)</th>
            <th>Quantity</th>
            <th>Subtotal($)</th>
        </thead>
        <tbody>

            <?php
            $total = 0;
            for ($i = 0; $i < count($_SESSION['selected']); $i++) {
                echo "<tr><td>" . ($i + 1) . "</td>";
                $id = $_SESSION['cart'][$_SESSION['selected'][$i]];
                $product = mysqli_fetch_assoc(get_product_by_id($id));
                echo "<td><div class='thumbnail'><img src='./products" . $product['img_path'] . "' width='100px'></div></td>";
                echo "<td>" . $_SESSION['size'][$_SESSION['selected'][$i]] . "</td>";
                echo "<td>" . number_format($product['price'], 2) . "</td>";
                echo "<td>" . $_SESSION['qty'][$_SESSION['selected'][$i]] . "</td>";
                $_SESSION['price'][$_SESSION['selected'][$i]] = $product['price'];
                $subtotal = $product['price'] * $_SESSION['qty'][$_SESSION['selected'][$i]];
                echo "<td class='subtotal'>" . number_format($subtotal, 2) . "</td></tr>";
                $total += $subtotal;
            }
            ?>
        </tbody>


        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td colspan="2"><strong>Total Amount:</strong>
                </td>
                <td id="total">$<?php echo number_format($total, 2) ?></td>
            </tr>

        </tfoot>
    </table>


    <div class="customer_info">
        <form action="./confirmation.php" method="post">
            <div>
                <label for="address">Shipping address:</label>
                <input type="text" name='address' oninput='removeValidationInfo();' size="50" value="<?php echo "" . $address; ?>" disabled>
                <input type="button" name="address_update" value="Update" onclick="updateAddress();">
                <!-- <input type="textarea" name="address" id="address" value="address testing"> -->
            </div>
            <div>
                <label for="credit_card">Credit Card No:</label>
                <?php
                echo "<input type='text' name='credit_card' oninput='removeValidationInfo();' size='50' value=";
                echo "'" . $creditcard . "'";
                if (strlen($creditcard) > 0) {
                    echo "disabled>";
                    echo "<input type='button' name='creditcard_update' value='Update' onclick='updateCreditCard();' >";
                } else {
                    echo ">";
                }
                ?>
            </div>
            <div class='validation' style="display: block;"></div>

    </div>

    <div class="action">
        <input type="submit" onclick="return validatePaymentInfo();" value="Order Now"></form>
        <a href="./shoppingcart.php"><button>Back to Cart</button></a>

    </div>

    <!-- The Modal -->
    <div id="id01" class="modal">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
        <!-- Modal Content -->
        <div class="modal-content animate">
            <div class="container" style="text-align:center;">
                Your order has been processed!
            </div>
            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="window.location.href='./shopping.php'" class="popup">Shop Again</button>
                <button type="button" onclick="window.location.href='./logout.php'" class="popup">Logout</button>
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
    <?php
    if (isset($_GET['redirect'])) {
        echo "<script> document.getElementById('id01').style.display='block';</script>";
    }
    ?>

    <script src="./javascript/shopping.js"></script>



    <?php require("./template/footer.php") ?>