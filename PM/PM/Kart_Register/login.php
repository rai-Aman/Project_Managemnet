<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login Page </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
  <!-- //bootstrap -->

  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="login.css">
  <!-- end bootstrap -->

</head>

<body>
  <!-- form start here -->
  <div class="box-form">

    <div class="left">
      <div class="overlay">

      </div>
    </div>


    <div class="right">
      <div class="imgcontainer">
        <img src="footer-log.png" alt="Avatar" class="avatar">
      </div>

      <h5> Welcome to Kartstreak </h5>
      <p>Don't have an account? <a href="#">Creat Your Account</a> it takes less than a minute</p>
      <form action="login_validation.php" method="post">
        <div class="inputs">
          <input type="email" name="username" placeholder="Email">
          <br>
        </div>
        
        <div>
          <input type="password" name="password" placeholder="Password">
        </div>
        <div class="validate_message">
          <?php
          if (isset($_SESSION["empty_username_password"])) {
            echo $_SESSION["empty_username_password"];
            unset($_SESSION["empty_username_password"]);
          }
          ?>
        </div>
        <div class="validate_message">
          <?php
          if (isset($_SESSION["Login_failed"])) {
            echo $_SESSION["Login_failed"];
            unset($_SESSION["Login_failed"]);
          }
          ?>
        </div>
        <div class="validate_message">
          <?php
          if (isset($_SESSION["Inactive_User"])) {
            echo $_SESSION["Inactive_User"];
            unset($_SESSION["Inactive_User"]);
          }
          ?>
        </div>
        <div class="validate_message">
          <?php
          if (isset($_SESSION["activate_account"])) {
            echo $_SESSION["activate_account"];
            unset($_SESSION["activate_account"]);
          }
          ?>
        </div>
        <div class="validate_message">
          <?php
          if (isset($_SESSION["wrong_credentials"])) {
            echo $_SESSION["wrong_credentials"];
            unset($_SESSION["wrong_credentials"]);
          }
          ?>
        </div>

        <div class="validate_message">
          <?php
          if (isset($_SESSION["activation_failed_message"])) {
            echo $_SESSION["activation_failed_message"];
            unset($_SESSION["activation_failed_message"]);
          }
          ?>
        </div>

        <div class="validate_message">
          <?php
          if (isset($_SESSION["activation_complete_message"])) {
            echo $_SESSION["activation_complete_message"];
            unset($_SESSION["activation_complete_message"]);
          }
          ?>
        </div>
        
        <div class="validate_message">
          <?php
          if (isset($_SESSION["new_pass"])) {
            echo $_SESSION["new_pass"];
            unset($_SESSION["new_pass"]);
          }
          ?>
        </div>
        <div class="validate_message">
          <?php
          if (isset($_SESSION["p_changed"])) {
            echo $_SESSION["p_changed"];
            session_destroy();
          }
          ?>
        </div>


        <!-- <button>Log In</button> -->
        <!-- <input type="submit" name="login"> -->
        <button type="submit" class="btn mt-4" name="login">Login</button>



        <br><br>

        <div class="buttonright">
          <button>Register as costumer</button>

        </div>
        <div class="buttonleft">
          <button>Register as trader</button>

        </div>

        <br>

    </div>

  </div>


</body>

</html>