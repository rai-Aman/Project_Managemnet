<?php
include("session.php");
if (empty($_SESSION["user_name"])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="shstyle.css">
</head>

<body>

    <div class="container">
        <form action="addshop_val.php" method="post">
            <h3 style="text-align:center;">Add Shop </h3>
            <div class="imgcontainer">
                <img src="footer-log.png" alt="Avatar" class="avatar">
            </div>
            <label for="sname">Shop Name</label>
            <input type="text" id="sname" name="name" placeholder="Shop Name..">

            <label for="sloaction">Shop Location</label>
            <input type="text" id="sloaction" name="location" placeholder=" Shop Loaction..">

            <label for="rnumber">What Do you want to sell? </label>
            <input type="text" id="rnumber" name="sell" placeholder="Shop type">

            <button class="btn btn-danger send" name="add">Add shop</button>
    </div>

    <div class="validation_message">
        <?php
        if (isset($_SESSION["more_shop"])) {
            echo $_SESSION["more_shop"];
            unset($_SESSION["more_shop"]);
        }
        ?>
    </div>
    <div class="validation_message">
        <?php
        if (isset($_SESSION["activate_accounts"])) {
            echo $_SESSION["activate_accounts"];
            unset($_SESSION["activate_accounts"]);
        }
        ?>
    </div>

    <div class="validation_message">
        <?php
        if (isset($_SESSION["activate_account"])) {
            echo $_SESSION["activate_account"];
            unset($_SESSION["activate_account"]);
        }
        ?>
    </div>
    <div class="validation_message">
        <?php
        if (isset($_SESSION["Non_Repeated_Shopname"])) {
            echo $_SESSION["Non_Repeated_Shopname"];
            unset($_SESSION["Non_Repeated_Shopname"]);
        }
        ?>
    </div>
    </form>
    </div>

</body>

</html>

</html>