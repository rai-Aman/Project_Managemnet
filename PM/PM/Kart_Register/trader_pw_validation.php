<?php
include("session.php");
include("connection.php");
include_once("function.php");

if (isset($_POST['reset'])){
    if (!empty($_POST["currentpw"]) && !empty($_POST["newpw"]) && !empty($_POST["confirmpw"])){

        $c_password = $_POST['currentpw'];
        $new = $_POST['newpw'];
        $confirm = $_POST['confirmpw'];
        $c_password = check_password($conn, $c_password);
        $new_password = trader_validate_password($new);
        // $new = trader_validate_password($new);
        if($new == $confirm){
            $sql = oci_parse($conn, "UPDATE KART_USER SET PASSWORDS = '$confirm'");

            if (oci_execute($sql)) {
                // ======
                $fullname = $_SESSION["full_name"];
                $user_email = $_SESSION["user_name"];

    $subject = "Email Activation";
    $msg = "<html>

<head>
</head>
<body>
<h3> $fullname Your password has been succesfully changed.</h3>
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
        $_SESSION['p_changed'] = "Password changed succesfully";
        header("Location:login.php");

    }
 // ======
               
            }
        }
        else{
            $_SESSION['not_match'] = "Password did not match with the supplied password";
            header("Location:trader_password.php");

        }
    }
    else{
        $_SESSION['empty'] = "Password Must not be empty";
        header("Location:trader_password.php");
    }
}

?>