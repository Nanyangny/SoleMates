<?php

define("DB_SERVER", "localhost");
define("DB_USER", "f36ee");
define("DB_PASSWORD", "f36ee");
define("DB_NAME", "f36ee");


function db_connect()
{
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
    confirm_db_connect();
    return $db;
}

function confirm_db_connect()
{
    if (mysqli_connect_errno()) {
        $msg = "Database connection failed: ";
        $msg .= mysqli_connect_error();
        $msg .= " (" . mysqli_connect_errno() . ")";
        exit($msg);
    }
}

function close_connection($connection)
{
    if (isset($connection)) {
        mysqli_close($connection);
    }
}
function is_post_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'POST';
}
function is_get_request()
{
    return $_SERVER['REQUEST_METHOD'] == 'GET';
}

function db_escape($db, $query)
{
    return mysqli_real_escape_string($db, $query);
}

function confirm_result_set($result)
{
    if (!isset($result)) {
        echo "error";
        exit("Database query failed");
    }
}


function get_array_element($array, $index)
{
    $result = [];
    $count = count($index);
    if ($count > 0) {
        for ($i = 0; $i < $count; $i++) {
            array_push($result, $array[$index[$i]]);
        }
        return join("','", $result);
    }
    return join("','", $array);
}



function get_product_by_id($id)
{
    global $db;
    $query = "SELECT * FROM shoes WHERE id=$id";
    return mysqli_query($db, $query);
}

function get_product_by_id_size($id, $size)
{

    global $db;
    $query = "SELECT * FROM shoes join stock on shoes.id = stock.product_id where  shoes.id=$id and size =$size";
    return mysqli_query($db, $query);
}


function get_user_by_name($name)
{
    global $db;
    $query = "SELECT * FROM users WHERE username = '$name'";
    $res = mysqli_query($db, $query);
    return $res;
}

function get_address_by_name($name)
{
    $res = get_user_by_name($name);
    $user = mysqli_fetch_assoc($res);
    return $user['address'];
}

function get_cc_by_name($name)
{
    $res = get_user_by_name($name);
    $user = mysqli_fetch_assoc($res);
    return $user['credit_card'];
}

function update_user_address($id, $address)
{
    global $db;
    $query = "UPDATE users SET address = '$address' where user_id= $id ;";
    echo $query;
    mysqli_query($db, $query);
    // echo $query;
    // echo("Error description: " . $db -> error);
}

function update_user_cc($id, $cc)
{
    global $db;
    $query = "UPDATE users SET credit_card = '$cc' where user_id =  $id ;";
    mysqli_query($db, $query);
    // echo $query;
    // echo("Error description: " . $db -> error);
}

function get_user_id_by_name($name)
{
    global $db;
    $query = "SELECT user_id FROM users where username='$name'";
    $res = mysqli_query($db, $query);
    return mysqli_fetch_assoc($res)['user_id'];
}

function update_order($user_id)
{
    global $db;
    $query = "select max(distinct order_id)+1 as new_id from orders";
    $order_id = mysqli_fetch_assoc(mysqli_query($db, $query))['new_id'];
    $query1 = " ";
    $query2 = " ";
    $date = date("Y-m-d h:i:sa");
    for ($i = 0; $i < count($_SESSION['selected']); $i++) {
        $product = $_SESSION['cart'][$_SESSION['selected'][$i]];
        $size = $_SESSION['size'][$_SESSION['selected'][$i]];
        $price = $_SESSION['price'][$_SESSION['selected'][$i]];
        $qty = $_SESSION['qty'][$_SESSION['selected'][$i]];
        $query1 .= "INSERT INTO orders values($order_id,$user_id,$product,$size,$qty,$price,'$date');";
        $query2 .= "UPDATE stock set qty = (qty -1) Where product_id = $product and size=$size;";
        unset($_SESSION['cart'][$_SESSION['selected'][$i]]);
        unset($_SESSION['size'][$_SESSION['selected'][$i]]);
        unset($_SESSION['qty'][$_SESSION['selected'][$i]]);
        unset($_SESSION['price'][$_SESSION['selected'][$i]]);
    }
    echo $query2;
    $res = mysqli_query($db, $query1); // update order table 
    $res = mysqli_query($db, $query2); // update stock table
    // echo "row affected". mysqli_affected_rows($db);
    unset($_SESSION['selected']);
    $_SESSION['num_cart'] = count($_SESSION['cart']);
    echo("Error description: " . $db -> error);
}




function gettopseller()
{
    global $db;
    $query = "SELECT img_path, orders.product as id 
    FROM orders
    JOIN shoes ON orders.product = shoes.id
    GROUP BY orders.product
    ORDER BY SUM( qty ) desc
    LIMIT 4";
    return  mysqli_query($db, $query);
}

function checkstock($id)
{
    global $db;
    $query = "SELECT product_id,stock.size,stock.qty FROM stock join shoes on stock.product_id = shoes.id  where stock.qty > 0 and product_id=$id ";
    return mysqli_query($db, $query);
}

function get_query_by_type($type)
{
    global $db;
    $query = "SELECT * from feedback where category = '$type' and display=1;";
    return mysqli_query($db, $query);
}



function get_category_report($type, $start_date, $end_date)
{
    // type => category, gender, brand
    global $db;
    $query = "SELECT $type  AS cat, SUM( qty ) AS volume, SUM( qty * orders.price ) AS sale
    FROM orders
    JOIN shoes ON orders.order_id = shoes.id 
    Where order_time >='$start_date' and order_time<='$end_date'
    GROUP BY $type order by volume desc";
    return mysqli_query($db, $query);
}

function calculateTotalSale($start_date, $end_date)
{
    global $db;
    $query = "SELECT count( distinct order_id ) AS order_num, SUM( qty * price ) AS sale
    FROM orders
    WHERE order_time >= '$start_date'
    AND order_time <= '$end_date'";
    return mysqli_query($db, $query);
}

function searchUnansweredQuery(){
    global $db;
    $query = "SELECT *
    FROM `feedback`
    WHERE answer IS NULL";
    return mysqli_query($db,$query);
}
function updateFeedbackAnswerAndDisplay($id,$answer,$display,$cat){
    global $db;
    $query = "UPDATE feedback set answer = '$answer', display=$display, category='$cat' WHERE id=$id";
    mysqli_query($db,$query);
    // echo $query;
    // echo("Error description: " . $db -> error);

}

function searchQueryById($id){
    global $db;
    $query = "SELECT *
    FROM `feedback`
    WHERE id =$id";
    return mysqli_query($db,$query);
}

function deleteQueryById($id){
    global $db;
    $query = "DELETE
    FROM `feedback`
    WHERE id =$id";
    mysqli_query($db,$query);
    echo $query;
    echo("Error description: " . $db -> error);
}
function insertQuery($answer,$query,$cat,$display){
    global $db; 
    $query = "INSERT into feedback (question,answer, username,display,category) VALUES ('$query','$answer','admin',$display,'$cat')";
    echo $query;
    mysqli_query($db,$query);
    echo("Error description: " . $db -> error);

}

function registerUser($username,$gender,$birthday,$email,$address,$password){
    global $db;
    $res = Array();
    // $username = $_POST['username'];
    // $gender = $_POST['gender'];
    // $birthday = $_POST['birthday'];
    // $email = $_POST['Email'];
    // $address = $_POST['shippingaddress'];
    // $password = $_POST['password'];
  
    $password = md5($password);
    $sql = "SELECT * FROM f36ee.users WHERE username = '$username'";
    //  echo "<br>" .$query. "<br>";
    $result1 = $db->query($sql);
    
    
    if (mysqli_num_rows($result1)) {
      $message =  "The username has been used!";
      $response = 1;
    } else {
      // check whether birthday is provided
      if (strlen($_POST['birthday']) > 1) {
        $sql = "INSERT INTO f36ee.users (username, gender, birthday, email, address, password)
        VALUES ('$username', '$gender','$birthday','$email','$address','$password')";
      } else {
        $sql = "INSERT INTO f36ee.users (username, gender, email, address, password)
        VALUES ('$username', '$gender','$email','$address','$password')";
      }
    
      $result2 = $db->query($sql);
      if (!$result2) {
        $response = 2;
        $message = "Your query failed";
      } else {
        $response = 3;
        $message = $username . " , You are registered.";
      }
    }
    $res['message']=$message;
    $res['response']=$response;
      return $res;
  }
  