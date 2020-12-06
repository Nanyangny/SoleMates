<?php
include "dbconnect.php";

function registerUser($username,$gender,$birthday,$email,$address,$password){
  global $dbcnx;
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
  $result1 = $dbcnx->query($sql);
  
  
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
  
    $result2 = $dbcnx->query($sql);
    if (!$result2) {
      $response = 2;
      $message = "Your query failed";
    } else {
      $response = 3;
      $message = "Welcome" . $username . ". You are now registered";
    }
  }
  $res['message']=$message;
  $res['response']=$response;
    return $res;
}









?>



<!-- Please have a nicer redirect -->

<!DOCTYPE html>
<html>

<head>
  <title>SoleMates - Redirecting</title>
  <meta http-equiv="refresh" content="2; url = ../login.php" />
</head>

<body>
  <p>Redirecting to login page</p>
</body>

</html>