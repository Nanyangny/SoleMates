<?php
function redirect_to($location)
{
  header("Location: " . $location);
  exit;
}

function showAlertBox($message)
{
  echo '<script language="javascript">';
  echo "confirm('" . $message . "')";
  echo '</script>';
}


function groupCart($update)
{

  $shoe_id_size = explode("|", $update)[0];
  $id = explode("_", $update)[0];
  $size = explode("|", explode("_", $update)[1])[0];
  $qty = explode("|", $update)[1];
  if(isset($_SESSION['cart'][$shoe_id_size])){
    $_SESSION['qty'][$shoe_id_size] += $qty;
  }
  else{
    $_SESSION['cart'][$shoe_id_size] = $id;
    $_SESSION['size'][$shoe_id_size] = $size;
    $_SESSION['qty'][$shoe_id_size] = $qty;
  }
  if(isset($_SESSION['num_cart'])){
    $_SESSION['num_cart']=count($_SESSION['cart']);
  }
  // var_dump($_SESSION['num_cart']);
}

function showShoppingCartRow($price, $qty, $size, $path, $stock,$name)
{
  echo "<tr'><td><input name='shoe_select' type=\"checkbox\" onchange='updateTotalItem()';></td>";
  echo "<td><div class=\"thumbnail\"><img src=\"./products/" . $path . "\" width=\"100px\"></div></td>";
  echo "<td><div class=\"desc\">".$name."</div></td>";
  echo "<td>" . $size . "</td>";
  echo "<td class='price'>" . number_format($price, 2) . "</td>";
  echo "<td ><div class=\"qty\"><div class=\"number-input\"><button onclick=\"this.parentNode.querySelector('input[type=number]').stepDown();calculateTotalAmount();\" class='minus'></button>";
  echo "<input class=\"quantity\" min=\"1\" name=\"quantity\" value='" . $qty . "' type=\"number\" max='$stock'>";
  echo "<button onclick=\"this.parentNode.querySelector('input[type=number]').stepUp();calculateTotalAmount();\" class=\"plus\"></button></div><br>Stock:<span name='stock'>" . $stock . "</span></div></td></tr>";
}

function deleteCartRow($key_list)
{
  $keys = explode(",",$key_list);
  for($i=0;$i<count($keys);$i++){
    unset($_SESSION['cart'][$keys[$i]]);
    unset($_SESSION['size'][$keys[$i]]);
    unset($_SESSION['qty'][$keys[$i]]);
  }
  
}

function updateCartQty($qty_list)
{
  $qty=explode(",",$qty_list);
  for ($i = 0; $i < count($_SESSION['cart']); $i++) {
    $id_size = array_keys($_SESSION['cart'])[$i];
    $_SESSION['qty'][$id_size]=$qty[$i];
  }
}

function checkLogin(){

    if(isset($_SESSION['valid_user'])){
      return true;
    }
    else{
      return false;
    }
}
