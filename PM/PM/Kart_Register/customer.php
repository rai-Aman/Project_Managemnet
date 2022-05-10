<?php
include("session.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="costyle.css">


    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.6/css/unicons.css">
    <!-- bootstrap -->

    <title>Document</title>
</head>

<body>

    <div class="section">
        <div class="container">

            <h6 class="mb-0 pb-3"><span>Customer</span></h6>


            <div class="card-back">

                <div class="section text-center">
                    <div class="gifcontainer">
                        <img src="aa.gif" alt="Avatar" class="avatar1">
                    </div>

                    <h4 style="padding-bottom: 2rem;color: white;">Customer Page</h4>
                    <form action="registration.php" method="post">

                        <div class="form-group">
                            <input type="text" name="fullname" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off">
                            <i class="input-icon uil uil-user"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="email" name="email" class="form-style" placeholder="Your Email" id="logemail" autocomplete="off">
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
                            <input type="password" name="confirm_password" class="form-style" placeholder="Confirm Password" id="c_logpass" autocomplete="off">
                            <i class="input-icon uil uil-lock-alt"></i>
                        </div>
                        <div class="form-group mt-2">
                            <input type="Phone" name="contact" class="form-style" placeholder="Your Phone Number" id="logpass" autocomplete="off">
                            <i class="input-icon uil uil-calling"></i>
                        </div>

                        <button type="submit" class="btn mt-4" name="register" style="background-color: white;">Register</button>
                        </p>
                        <div class="validate_message">
                            <?php
                            if (isset($_SESSION["empty_customer_field"])) {
                                echo $_SESSION["empty_customer_field"];
                                unset($_SESSION["empty_customer_field"]);
                            }
                            ?>
                        </div>
                        <!-- <a href="#" class="btn mt-4"
                                            style="background-color: aliceblue;">submit</a> -->
                    </form>
                </div>
                <!-- </div> -->
            </div>

            <!-- </div>
                </div>
            </div> -->
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>