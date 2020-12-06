<html>

<head>
  <meta charset="utf-8">
  <title>Sole Mates - Registration Page</title>
  <script type="text/javascript" src="./javascript/registration.js"></script>
  <link rel="stylesheet" href="./styles/main.css">
  <!-- can add additional css to this html -->
</head>
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

  .modal {
    display: none;
    /* Hidden by default */
    position: fixed;
    /* Stay in place */
    z-index: 1;
    /* Sit on top */
    left: 0;
    top: 0;
    width: 100%;
    /* Full width */
    height: 100%;
    /* Full height */
    overflow: auto;
    /* Enable scroll if needed */
    background-color: rgb(0, 0, 0);
    /* Fallback color */
    background-color: rgba(0, 0, 0, 0.4);
    /* Black w/ opacity */
    padding-top: 60px;
  }

  /* Modal Content/Box */
  .modal-content {
    background-color: white;
    margin: 15% auto;
    /* 15% from the top and centered */
    border: 1px solid #888;
    width: 20%;
    border: solid black;
    border-radius: 0.3rem;
    /* Could be more or less, depending on screen size */
  }

  /* The Close Button */
  .close {
    /* Position it in the top right corner outside of the modal */
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
  }

  /* Close button on hover */
  .close:hover,
  .close:focus {
    color: red;
    cursor: pointer;
  }

  .container {
    padding: 3%;
  }

  .container button {
    margin: 0 35%;
    background-color: black;
    color: white;
    padding: 5px;
    width: 25%;
  }

  /* Add Zoom Animation */
  .animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
  }

  @keyframes animatezoom {
    from {
      transform: scale(0)
    }

    to {
      transform: scale(1)
    }
  }
</style>
<?php require_once("./template/header.php");

if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $gender = $_POST['gender'];
  $birthday = $_POST['birthday'];
  $email = $_POST['Email'];
  $address = $_POST['shippingaddress'];
  $password = $_POST['password'];
  $result = registerUser($username, $gender, $birthday, $email, $address, $password);
  $res = $result['response'];
  $message = $result['message'];
}

?>

<div class="wrapper">
  <br>

  <!-- <div style="margin-left: 5%; margin-top: 30px;"> -->

  <div class="register_left"> <img src="images/main1.jpg"></div>


  <div class="registration_form">

    <!-- <form action="./php/register.php" method=post> -->
    <!-- <h1 style="padding:1rem;text-align:center;">Register</h1>
      <br>
      <div>
        <label for="username"><span class="asterisk">&#42;</span> Username:</label>
        <input type="text" name="username" id="username" required>
      </div>
      <div>
        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
          <option value="female">Female</option>
          <option value="male">Male</option>
          <option value="other">Other</option>
        </select>
      </div>
      <div>
        <label for="birthday">Birthday:</label>
        <input type="date" name="birthday" id="birthday">
      </div>

      <div>
        <label for="Email"><span class="asterisk">&#42;</span> E-mail:</label>
        <input type="text" name="Email" id="Email" required>
      </div>

      <div>
        <label for="shippingaddress"><span class="asterisk">&#42;</span> Shipping Address:</label>
        <input type="text" name="shippingaddress" id="shippingaddress" required></div>

      <div>
        <label for="password"><span class="asterisk">&#42;</span> Password:</label>
        <input type="password" name="password" id="password" required>
      </div>

      <div>
        <label for="password"><span class="asterisk">&#42;</span> Password Comfirmation:</label>
        <input type="password" name="password2" required>
      </div>
      <br>
      <br>
      <div class="action_bar">
        <input type="submit" name="submit" value="Submit" onclick="return reCheck();">
        <input type="reset" name="reset" value="Reset">
      </div>
      <div style="margin-left:30%;"><a style="text-decoration:underline;" href="login.php">Already Have Account? Login</a></div> -->
    <form action="./Registration.php" method=post>
      <div class="container">
        <h1>Register</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>

        <label for="username"><span class="asterisk">&#42;</span> <b>Username:</b></label>
        <input type="text" name="username" id="username" required>

        <label for="gender"><b>Gender:</b></label>
        <select id="gender" name="gender">
          <option value="female">Female</option>
          <option value="male">Male</option>
          <option value="other">Other</option>
        </select>

        <label for="birthday"><b>Birthday:</b></label>
        <input type="date" name="birthday" id="birthday">

        <label for="Email"><span class="asterisk">&#42;</span> <b>E-mail:</b></label>
        <input type="text" name="Email" id="Email" required>

        <label for="shippingaddress"><span class="asterisk">&#42;</span><b> Shipping Address:</b></label>
        <input type="text" name="shippingaddress" id="shippingaddress" required>


        <label for="password"><span class="asterisk">&#42;</span> <b>Password:</b></label>
        <input type="password" name="password" id="password" required>
        <label for="password2"><span class="asterisk">&#42;</span><b> Password Comfirmation:</b></label>
        <input type="password" name="password2" id="password2" required>

        <hr>

        <p>By creating an account you agree to our Terms & Privacy.</p>
        <input class="registerbtn" type="submit" name="submit" value="Submit" onclick="return reCheck();">
        <input class="registerbtn" type="reset" name="reset" value="Reset">
      </div>

      <div class="container signin">
        <p>Already have an account?<a style="text-decoration:underline;" href="login.php">Login</a>.</p>
      </div>
    </form>
  </div>
</div>

<!-- The Modal -->

<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <!-- Modal Content -->
  <div class="modal-content animate">
    <div class="container" style="text-align:center;">
      <?php
      if ($message) {
        echo $message;
      } ?>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <?php
      if (isset($_POST['username'])) {
        if ($res == 1 | $res == 2) {
          echo "<button type='button' onclick=\"document.getElementById('id01').style.display='none';\" class='popup'>Try Again</button></div>";
        } else {
          echo "<button type='button' onclick=\"window.location.href='./login.php?'\" class='popup'>Login</button></div>";
        }
      }
      ?>
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
if (isset($_POST['username'])) {
  echo "<script>document.getElementById('id01').style.display='block';</script>";
}
?>




<script type="text/javascript" src="./javascript/registrationr.js"></script>

<?php require("./template/footer.php") ?>