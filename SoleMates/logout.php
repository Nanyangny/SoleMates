<?php
session_start();

// store to test if they *were* logged in
$old_user = $_SESSION['valid_user'];
unset($_SESSION['valid_user']);
session_destroy();

header("location:" . "./login.php");

?>
<html>

<head>

  <meta charset="utf-8">
  <title>Sole Mates - Login</title>
  <link rel="stylesheet" href="./styles/main.css">

</head>

<?php require_once("./template/header.php"); ?>

<div class="wrapper">
  <br>
  <h1 style="text-align: center;">Log out</h1>
  <br><br>
  <?php
  if (!empty($old_user)) {
    echo 'Logged out.<br /><br><br>';
  } else {
    // if they weren't logged in but came to this page somehow
    echo 'You were not logged in, and so have not been logged out.<br /><br><br>';
  }
  ?>
  <a style="text-decoration:underline;" href="login.php">Back to login page</a>
  <br><br>
  <br><br>
  <br><br>
  <br><br>
  </body>
</div>
<?php require("./template/footer.php") ?>