<?php
include("session.php");
include("connection.php");
$_SESSION["Invalid_email"] = "";
$_SESSION["Strong_password"] = "";
$_SESSION["Non_Repeated_Username"] = "";
$_SESSION["activate_account"] = "";
$_SESSION["user_login"] = "";
$_SESSION["Non_Repeated_Shopname"] = "";

// ==================== Function for email validation =====================

function validate_email($email, $role)
{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["Invalid_email"] = "Invalid email format";
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    } else {
        return $email;
    }
}


// ==================== Function for password validation=====================
function validate_password($password, $role)
{
    if (strlen($password) < 8) {
        $_SESSION["Strong_password"] = "Your Password Must Contain At Least 8 values";
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    } elseif (!preg_match("#[0-9]+#", $password)) {
        $_SESSION["Strong_password"] = "Your Password Must Contain At Least 1 Number.";
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    } elseif (!preg_match("#[A-Z]+#", $password)) {
        $_SESSION["Strong_password"] = "Your password must contain atleast one capital letter";
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    } elseif (!preg_match("#[a-z]+#", $password)) {
        $_SESSION["Strong_password"] = "Your password must contain atleast one lowercase letter";
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    } elseif (!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $password)) {
        $_SESSION["Strong_password"] = "Your Password missing special character";
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    } else {
        return $password;
    }
}
// ==================== Function for trader password validation=====================
function trader_validate_password($new)
{
    if (strlen($new) < 8) {
        $_SESSION["Strong_password"] = "Your Password Must Contain At Least 8 values.";
        header("Location:trader_password.php");
        exit();
    } elseif (!preg_match("#[0-9]+#", $new)) {
        $_SESSION["Strong_password"] = "Your Password Must Contain At Least 1 Number.";
        header("Location:trader_password.php");
        exit();
    } elseif (!preg_match("#[A-Z]+#", $new)) {
        $_SESSION["Strong_password"] = "Your password must contain atleast one capital letter";
        header("Location:trader_password.php");
        exit();
    } elseif (!preg_match("#[a-z]+#", $new)) {
        $_SESSION["Strong_password"] = "Your password must contain atleast one lowercase letter";
        header("Location:trader_password.php");
        exit();
    } elseif (!preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $new)) {
        $_SESSION["Strong_password"] = "Your Password missing special character";
        header("Location:trader_password.php");
        exit();
    } else {
        return $new;
    }
}

// ==================== Function for username validation =====================


function validate_username($conn, $role, $email)
{
    if (!$conn) {
        $err = oci_error();
        trigger_error(htmlentities($err['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $sql = "select * from kart_user where email='$email'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);

    $total_user = 0;
    while (($row = oci_fetch_array($stid)) == true) {
        ++$total_user;
    }
    oci_free_statement($stid);
    oci_close($conn);
    if ($total_user == 0) {
        return $email;
    } else {
        $_SESSION["Non_Repeated_Username"] = "Email already in use!!";
        // header("Location: customer.php");
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    }
}

//==================Login function==========================\

function user_login($conn, $username, $password)
{
    if (!$conn) {
        $err = oci_error();
        trigger_error(htmlentities($err['message'], ENT_QUOTES), E_USER_ERROR);
    }

    $sql = "SELECT * FROM KART_USER WHERE USER_NAME='$username'and PASSWORDS='$password'";
    $stid = oci_parse($conn, $sql);
    if (oci_execute($stid)) {
        while (($row = oci_fetch_array($stid)) == true) {

            $fullname = $row["FULL_NAME"];
            $statuss = $row["STATUSS"];
            $userid = $row["USER_ID"];
            $roles = $row["ROLES"];
            $username = $row["USER_NAME"];
        }
    }
    if (empty($userid)) {
        $_SESSION["error_credentials"] = "Invalid Credentials";
        header("Location:login.php");
    } else {

        if ($statuss == '1') {
            $_SESSION["statuss"] = $statuss;
            $_SESSION["full_name"] = $fullname;
            $_SESSION["user_id"] = $userid;
            $_SESSION["user_name"] = $username;
            $_SESSION["roles"] = $roles;

            if ($_SESSION["roles"] == 'Customer') {
                header("Location: homepage.php");
            } elseif ($_SESSION["roles"] == 'Trader') {
                header("Location:dashboard.php");
            } elseif ($_SESSION["roles"] == 'Admin') {
                header("Location: admin_dashboard.php");
            } else {
                $_SESSION["roles"] = "Anonymous";
                header("Location: login.php");
            }
        } else {
            $_SESSION["Inactive_User"] = "Your account is inactive";
            header("Location: login.php");
        }
    }
}






// ================== Gmail verfication =====================

function verify_email($fullname, $token, $email)
{

    $user_email = $email;
    $subject = "Email Activation";
    $msg = "<html>

<head>
</head>
<body>
<h3> $fullname Welcome, at KartStreak online shopping website.</h3>
<p>Please click below to activate your account : http://localhost/Kart_Register/activate.php?token=$token</p>

</body>
</html>
";
    $eol = PHP_EOL;

    $header = "MIME-Version: 1.0" . $eol;
    $header .= "Content-type:text/html;charset=UTF-8" . $eol;
    $header .= "From: kartstreak123@gmail.com" . $eol;
    $header .= "Reply-To: kartstreak123@gmail.com" . $eol;


    $mail_sent = mail($user_email, $subject, $msg, $header);
    if ($mail_sent == true) {
        $_SESSION["activate_account"] = "Check your gmail to activate your account $email";
        header("location: login.php");
    }
}



// ========================Validate Shop======================

function validate_shop($conn, $role,$shop_name)
{
    if (!$conn) {
        $err = oci_error();
        trigger_error(htmlentities($err['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $sql = "SELECT * FROM SHOP WHERE SHOP_NAME='$shop_name'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);

    $total_shop = 0;

    oci_free_statement($stid);
    oci_close($conn);
    if ($total_shop == 0) {
        return $shop_name;
    } else {
        $_SESSION["Non_Repeated_Shopname"] = "Shop name already taken!!";
        // header("Location: trader.php");
        header("Location: customer.php");
        if ($role == 'Customer') {
            header("location: customer.php");
        }
        if ($role == 'Trader') {
            header("Location: trader.php");
        }
    }
}


// ==================CHECK PASSWORDS =========================

function check_password($conn, $c_password)
{
    if (!$conn) {
        $err = oci_error();
        trigger_error(htmlentities($err['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $sql = "SELECT * FROM KART_USER WHERE PASSWORDS='$c_password'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);
    $password = 0;
    while (($row = oci_fetch_array($stid)) == true) {
        ++$password;
    }
    oci_free_statement($stid);
    oci_close($conn);
    if ($password == 1) {
        return $password;
    } else {
        $_SESSION['current_passwords'] = "Password did not match with current password";
        header("Location:trader_password.php");
        exit();
    }
}






// ================== Trader_Gmail verfication =====================

function trader_verify_email($fullname, $email)
{
    $token = $_SESSION['token'];
    $trader_email = $email;
    $subject = "Trader Activation";
    $msg = "<html>
<head>
</head>
<body>
<h3>Hello Trader $fullname Welcome, at KartStreak online shopping website.</h3>
<p>Please click below to activate your account : http://localhost/Kart_Register/trader_activation.php?token=$token</p>

</body>
</html>
";
    $eol = PHP_EOL;

    $header = "MIME-Version: 1.0" . $eol;
    $header .= "Content-type:text/html;charset=UTF-8" . $eol;
    $header .= "From: kartstreak123@gmail.com" . $eol;
    $header .= "Reply-To: kartstreak123@gmail.com" . $eol;


    $mail_sent = mail($trader_email, $subject, $msg, $header);
    if ($mail_sent == true) {
        $_SESSION["activate_account"] = "Check your gmail to activate your account $email";
        header("location: login.php");
    }
}

// ================== Shop_Gmail_verfication =====================

function shop_verify_email($fullname, $email)
{
    // $token = $_SESSION['token'];
    $admin_email = "kartstreak123@gmail.com";
    $approval_status = "Yes";

    $subject = "Shop Activation";
    $msg = "<html>
<head>
</head>
<body>
<h3>Hello Trader $fullname Welcome, at KartStreak online shopping website.</h3>
<p>Please click below to activate your account : http://localhost/Kart_Register/shop_activation.php?approval=$approval_status;
</p>

</body>
</html>
";
    $eol = PHP_EOL;

    $header = "MIME-Version: 1.0" . $eol;
    $header .= "Content-type:text/html;charset=UTF-8" . $eol;
    $header .= "From: kartstreak123@gmail.com" . $eol;
    $header .= "Reply-To: kartstreak123@gmail.com" . $eol;


    $mail_sent = mail($admin_email, $subject, $msg, $header);
    if ($mail_sent == true) {
        $_SESSION["activate_account"] = "Your shop activation is under process";
        header("location: Add_shop.php");
    }
}



// ======== User Foregin key===========
function f_key($conn, $name)
{
    $sql = "SELECT USER_ID FROM KART_USER WHERE USER_NAME='$name'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);

    while (($row = oci_fetch_array($stid)) != false) {
        $id = $row["USER_ID"];
    }
    if (!empty($id)) {
        return $id;
    }
}

// ============product name==================

function validate_product_name($conn, $p_name)
{
    if (!$conn) {
        $err = oci_error();
        trigger_error(htmlentities($err['message'], ENT_QUOTES), E_USER_ERROR);
    }
    $sql = "select * from product where product_name='$p_name'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);

    $total_name = 0;
    while (($row = oci_fetch_array($stid)) == true) {
        ++$total_name;
    }
    oci_free_statement($stid);
    oci_close($conn);
    if ($total_name == 0) {
        return $p_name;
    } else {
        $_SESSION["Non_Repeated_Product"] = "Product overlapping!!";
        header("Location: add_products.php");
    }
}

// ======== Shop Foregin key===========

function f_key_shop($conn)
{
    $user_id = $_SESSION["user_id"];

    $sql = "SELECT SHOP_ID FROM SHOP WHERE FK1_USER_ID ='$user_id'";
    $stid = oci_parse($conn, $sql);
    oci_execute($stid);

    while (($row = oci_fetch_array($stid)) != false) {
        $id = $row["SHOP_ID"];
    }
    if (!empty($id)) {
        return $id;
    }
}

// ======== Shop Foregin key===========

// function f_key_pc($conn, $cat_name)
// {
//     $sql = "SELECT CATEGORY_ID FROM SHOP WHERE CATEGORY_NAME ='$cat_name'";
//     $stid = oci_parse($conn, $sql);
//     oci_execute($stid);

//     while (($row = oci_fetch_array($stid)) != false) {
//         $id = $row["CATEGORY_ID"];
//     }
//     if (!empty($id)) {
//         return $id;
//     }
// }
