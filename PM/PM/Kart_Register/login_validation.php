<?php
include("session.php");
include("connection.php");

if (isset($_POST['login'])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $sql = " SELECT * FROM KART_USER WHERE USER_NAME= '$username' AND PASSWORDS= '$password'";
        $stid = oci_parse($conn, $sql);
        // oci_execute($stid);
        // if ($row = oci_fetch_assoc($stid)) {
        //     $_SESSION['register'] = $username;
        //     header("location:homepage.php");
        // } else {
        //     $_SESSION['error'] = "User not found";
        //     header("location:login.php");
        // }
        // header("Location:homepage.php");
        // $_SESSION['username'] = $username;
        oci_execute($stid);
        while (($row = oci_fetch_assoc($stid)) != false) {

            $userid = $row["USER_ID"];
            $fullname = $row["FULL_NAME"];
            $statuss = $row["STATUSS"];
            $roles = $row["ROLES"];
            $username = $row["USER_NAME"];
        }
        if (!empty($userid)) {
            if ($statuss == '1') {
                $_SESSION["statuss"] = $statuss;
                $_SESSION["full_name"] = $fullname;
                $_SESSION["user_id"] = $userid;
                $_SESSION["user_name"] = $username;
                $_SESSION["roles"] = $roles;
    
                if ($_SESSION["roles"] == 'Customer') {
                    header("Location: homepage.php");
                } elseif ($_SESSION["roles"] == 'Trader') {
                    header("Location:add_products.php");
                } elseif ($_SESSION["roles"] == 'Admin') {
                    header("Location: admin_dashboard.php");
                } else {
                    $_SESSION["roles"] == "Anonymous";
                    header("Location: login.php");
                }
            } else {
                $_SESSION["Inactive_User"] = "Your account is inactive";
                header("Location: login.php");
            }
        } else {
            $_SESSION["wrong_credentials"] = "Invalid Credentials";
            header("Location: login.php");
        }

    } else {
        $_SESSION["empty_username_password"] = "Field must not be empty";
        header("Location: login.php");
        exit();
    }
    
   
}
