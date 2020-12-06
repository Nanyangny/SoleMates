<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script>
    document.getElementsByTagName("html")[0].className += " js";
  </script>
  <link rel="stylesheet" href="./styles/main.css">
  <title>FAQ & Contact us | Sole Mates</title>
  <!-- can add additional css to this html -->
  <style>
    input[type=text],
    select,
    textarea {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
      resize: vertical;
    }

    input[type=submit]:hover {
      background-color: #45a049;
    }

    .container {
      border-radius: 5px;
      background-color: gainsboro;
      padding: 20px;
    }

    .FAQ {
      margin-left: 20px;
      margin-right: 20px;
    }

    .FAQ:after {
      content: "";
      display: table;
      clear: both;
    }

    .col {
      float: left;
      padding: 10px;
    }

    .col.but {
      width: 15%;
    }

    .col.right {
      width: 80%;
    }
  .container{
    width: 50%;
    margin: auto;
  }
  </style>
</head>

<?php
require_once("./template/header.php");


?>


<div class="wrapper">

  <div class="FAQ">

    <div class="col but">

      <button style="margin-top: 50px;width: 100px;" class="tablink" onclick="openCity(event, 'Basic')">Basic</button>
      <button style="margin-top: 50px; width: 100px;" class="tablink" onclick="openCity(event, 'Account')">Account</button>
      <button style="margin-top: 50px;width: 100px;" class="tablink" onclick="openCity(event, 'Payments')">Payments</button>
      <button style="margin-top: 50px;width: 100px;" class="tablink" onclick="openCity(event, 'Delivery')">Delivery</button>
      <br><br>

    </div>

    <div class="col right">
      <h2 style="text-align: center;">Frequently Asked Questions</h2>

      <?php

      $category = array('Payments', 'Delivery', 'Basic', 'Account');

      for ($i = 0; $i <= count($category); $i++) {
        echo "<div id='" . $category[$i] . "' class='type' style='display:none'>";
        $res = get_query_by_type($category[$i]);
        while ($row = mysqli_fetch_assoc($res)) {
          echo "<p><h4>" . $row['question'] . "</h4></p>";
          echo "<p>" . $row['answer'] . "</p>";
        }
        echo "</div>";
      }

      ?>

    </div>
  </div>

  <script>
    openCity(event, 'Basic'); // display basic on rendering

    function openCity(evt, type) {
      var i, x, tablinks;
      x = document.getElementsByClassName("type");
      for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablink");
      /*for (i = 0; i < x.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
      }*/
      document.getElementById(type).style.display = "block";
      /*evt.currentTarget.className += " w3-red";*/
    }
  </script>

  <!-- your webpage content here -->
<hr>
  <div class="container" id='contact_us'>
    <form action="./php/feedback.php" method=POST>

      <h2 style="text-align: center; padding-top:20px;">Contact us</h2>
      <label for="uname"><span class="asterisk">&#42;</span> Username</label>
      <?php
      if (isset($_SESSION['valid_user'])) {
        echo "<input type='text' id='uname' name='username' placeholder='Your username..' value='" . $_SESSION['valid_user'] . "' required>";
      } else {
        echo "<input type='text' id='uname' name='username' placeholder='Your username..' required>";
      }
      ?>
      <br>

      <label for="Email"><span class="asterisk">&#42;</span> E-mail:</label>
      <?php
      if (isset($_SESSION['valid_user'])) {
        $res = mysqli_fetch_assoc(get_user_by_name($_SESSION['valid_user']));
        echo "<input type='text' name='Email' id='Email' placeholder='Your email..'  value='" . $res['email'] . "' required><br />";
      } else {
        echo "<input type='text' name='Email' id='Email' placeholder='Your email..' required><br />";
      }
      ?>

      <label for="Category">Question Category</label>
      <select id="Category" name="Category">
        <option value="Basic">Basic</option>
        <option value="Delivary">Delivery</option>
        <option value="Payment">Payments</option>
        <option value="Account">Account</option>
      </select>
      <br>

      <label for="content"><span class="asterisk">&#42;</span> Content</label>
      <textarea id="content" name="content" placeholder="Write something.." style="height:200px" required></textarea>
      <br>

      <input type=submit name=submit value=Submit>
      <input type=reset name=reset value="Reset">
      <br><br>
    </form>
  </div>

</div>

<?php require("./template/footer.php") ?>