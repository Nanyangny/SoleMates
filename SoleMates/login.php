<html>

<head>
  <meta charset="utf-8">
  <title>Sole Mates - Login</title>
  <link rel="stylesheet" href="./styles/main.css">
</head>
<?php require_once("./template/header.php");

if (isset($_GET['product_id'])) {
  $_SESSION['from'] = $_GET['product_id'];
}
if (isset($_POST['username']) && isset($_POST['password'])) {
  // if the user has just tried to log in
  // var_dump($_POST);
  $username = $_POST['username'];
  $password = $_POST['password'];

  $password = md5($password);
  $sql = "SELECT * FROM f36ee.users WHERE username = '$username' AND password = '$password'";
  //  echo "<br>" .$query. "<br>";
  $result = mysqli_query($db, $sql);
  if (mysqli_num_rows($result)) {
    $_SESSION['valid_user'] = $username;
  }
}

?>

<style>
  .wrapper {
    height: auto;
    display: flex;
  }

  .register_left {
    width: 50%;
  }

  .register_left img {
    width: 80%;
    margin: 3%;
    padding: 6% 10%;
  }

  .registration_form {
    width: 50%;
  }

  /* * {
    box-sizing: border-box
  } */

  /* Add padding to containers */
  .container {
    padding: 16px;
  }

  /* Full-width input fields */
  input[type=text],
  input[type=password],
  input[type=date],
  select {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
  }

  input[type=text]:focus,
  input[type=password]:focus,
  select:focus {
    background-color: white;
    outline: none;
  }

  /* Overwrite default styles of hr */
  hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
  }

  /* Set a style for the submit/register button */
  .registerbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
  }

  .registerbtn:hover {
    opacity: 1;
  }


  /* Set a grey background color and center the text of the "sign in" section */
  .signin {
    /* background-color: #f1f1f1; */
    text-align: center;
  }
</style>

<div class="wrapper">

  <br>
  <div style="float:left;" class="register_left"> <img src="images/main1.jpg"></div>

  <div class="registration_form">
    <?php
    if (isset($_SESSION['valid_user'])) {
      // echo 'You are logged in as: ' . $_SESSION['valid_user'] . ' <br /><br />';
      // echo '<a style="text-decoration:underline;" href="logout.php">Log out</a><br /><br />';
      if (isset($_SESSION['from'])) {
        // direct back to the product page
        // unset($_SESSION['from']);
        header("location:" . "./product.php?id=" . $_SESSION['from']);
      } else {
        header("location:" . "./index.php");
      }
    } else {
      if (isset($username)) {
        // error handling for unsuccessful login
        // if they've tried and failed to log in
        echo "<script>alert('Login unsuccessful, please check your username and password!');</script>";
      } else {

        // they have not tried to log in yet or have logged out
        // echo 'You are not logged in.<br><br>';
      }

      // provide form to log in

      echo '<form method="post" action="./login.php">';
      echo "<div class='container'><h1>Login</h1><hr>";
      echo '<label for="username"><span class="asterisk">&#42;</span> <b>Username:</b></label>';
      echo '<input type="text" name="username" id="username" required>';
      echo '<label for="password"><span class="asterisk">&#42;</span> <b>Password:</b></label>';
      echo '<input type="password" name="password" id="password" required>';
      echo "<hr>";
      echo "<input class='registerbtn' type='submit' value='Log in'>";
      echo "<input class='registerbtn' type='reset' value='Reset'></div>";
      echo '</form>';
      echo '<div class="container signin">';
      echo '<p>New User? <a style="text-decoration:underline;" href="Registration.php">Registration</a></p></div>';
    }
    ?>







  </div>


  <br /><br />

</div>

<?php require("./template/footer.php") ?>