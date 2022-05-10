<?php
include("session.php");
if(empty($_SESSION["user_name"])){
    header("Location:login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!------ bootstrap start ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="passtyle.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!------ bootstrap ends ---------->


    <title>reset password</title>
</head>

<body>
    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Reset Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form id="register-form" role="form" action="trader_pw_validation.php" class="form" method="POST">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock" aria-hidden="true"></i></span>
                                            <input id="currentpw" name="currentpw" placeholder="Current Password" class="form-control" type="password">
                                        </div>
                                        <div class="validate_message">
                                            <?php
                                            if (isset($_SESSION["current_passwords"])) {
                                                echo $_SESSION["current_passwords"];
                                                unset($_SESSION["current_passwords"]);
                                            }
                                            ?>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock" aria-hidden="true"></i></span>
                                            <input id="newpw" name="newpw" placeholder="New Password" class="form-control" type="password">
                                        </div>
                                        <div class="validate_message">
                                            <?php
                                            if (isset($_SESSION["Strong_password"])) {
                                                echo $_SESSION["Strong_password"];
                                                unset($_SESSION["Strong_password"]);
                                            }
                                            ?>
                                        </div>

                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-lock" aria-hidden="true"></i></span>
                                            <input id="confirmpw" name="confirmpw" placeholder="Confirm Your Password" class="form-control" type="password">
                                        </div>
                                        <div class="validate_message">
                                            <?php
                                            if (isset($_SESSION["not_match"])) {
                                                echo $_SESSION["not_match"];
                                                unset($_SESSION["not_match"]);
                                            }
                                            ?>
                                        </div>
                                        <div class="validate_message">
                                            <?php
                                            if (isset($_SESSION["p_changed"])) {
                                                echo $_SESSION["p_changed"];
                                                unset($_SESSION["p_changed"]);
                                            }
                                            ?>
                                        </div>
                                        <div class="validate_message">
                                            <?php
                                            if (isset($_SESSION["empty"])) {
                                                echo $_SESSION["empty"];
                                                unset($_SESSION["empty"]);
                                            }
                                            ?>
                                        </div>

                                    </div>
                                    <div class="form-group">
                                        <input class="btn btn-lg btn-primary btn-block" value="Reset Password" name="reset" type="submit" style="background-color: rgb(244, 103, 30);">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>

</html>