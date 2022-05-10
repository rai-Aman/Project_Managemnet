<?php
include("session.php");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="restyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">

    <title>Registration form!</title>
</head>

<body>

    <div class="section">
        <div class="container">

            <div class="card-front">

                <div class="section text-center">
                    <!-- <div class="gifcontainer1">
                                                <img src="aa1.gif" alt="Avatar" class="avatar2">
                                              </div> -->
                    <div class="imgcontainer">
                        <img src="footer-log.png" alt="Avatar" class="avatar">
                    </div>
                    <h4 class="mb-4 pb-3" style="margin-left: -2rem">Create Your Account</h4>
                    <form action="trader_registration.php" method="post">

                        <div class="form-group">
                            <input type="name" name="fullname" class="form-style" placeholder="Your Full Name" id="logemail" autocomplete="of">
                            <i class="input-icon uil uil-user"></i>

                        </div>
                        <div class="form-group mt-2">

                            <input type="password" name="password" class="form-style" placeholder="Your Password" id="logpass" autocomplete="off">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>

                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["Strong_password"]))
                                echo $_SESSION["Strong_password"];
                            unset($_SESSION["Strong_password"]);
                            ?>
                        </div>
                        <div class="form-group mt-2">
                            <input type="password" name="confirm_password" class="form-style" placeholder="Confirm Your Password" id="logpass" autocomplete="off">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="email" name="email" class="form-style" placeholder="Your Email Id" id="logpass" autocomplete="off">
                            <i class="input-icon uil uil-at"></i>
                        </div>

                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["Invalid_email"])) {
                                echo $_SESSION["Invalid_email"];
                                unset($_SESSION["Invalid_email"]);
                            }
                            ?>
                        </div>
                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["Non_Repeated_Username"])) {
                                echo $_SESSION["Non_Repeated_Username"];
                                unset($_SESSION["Non_Repeated_Username"]);
                            }
                            ?>
                        </div>

                        <!-- <div class="form-group mt-2">
													<input type="Shop" name="shop_id" class="form-style" placeholder="Your Shop Id" id="logpass" autocomplete="off">
													<i class="input-icon uil uil-shopping-cart-alt"></i>
												</div> -->
                        <div class="form-group mt-2">
                            <input type="shopName" name="shopname" class="form-style" placeholder="Your Shop Name" id="logpass" autocomplete="off">
                            <i class="input-icon uil uil-shop"></i>
                        </div>
                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["Non_Repeated_Shopname"])) {
                                echo $_SESSION["Non_Repeated_Shopname"];
                                unset($_SESSION["Non_Repeated_Shopname"]);
                            }
                            ?>
                        </div>
                        <div class="form-group mt-2">
                            <input type="sell" name="sell" class="form-style" placeholder="What do you want to sell ?" id="logsell" autocomplete="off">
                            <i class="input-icon uil uil-pricetag-alt"></i>
                        </div>

                        <div class="form-group mt-2">
                            <input type="address" name="address" class="form-style" placeholder="Shop Address" id="logsell" autocomplete="off">
                            <i class="input-icon uil uil-pricetag-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="Phone" name="phone" class="form-style" placeholder="Your Phone Number" id="logpass" autocomplete="off">
                            <i class="input-icon uil uil-calling"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="checkbox" id="vehicle1" name="terms" value="Bike">
                            <label for="vehicle1"> I agree to all terms and services</label><br>
                        </div>
                        <div class="validate_message">
                            <?php
                            if (isset($_SESSION["Empty_field"])) {
                                echo $_SESSION["Empty_field"];
                                unset($_SESSION["Empty_field"]);
                            }
                            ?>
                        </div>
                        <!-- <a href="#" class="btn mt-4" -->
                        <!-- <p style="background-color: aliceblue;">Register -->
                        <button type="submit" class="btn mt-4" name="register" style="background-color: white;">Register</button>
                        <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your
                                password?</a></p>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- </div> -->












    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>


</body>

</html>