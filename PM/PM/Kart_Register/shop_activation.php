<?php
include("session.php");
include("connection.php");

$email = $_SESSION["t_email"];
$contact = $_SESSION["t_contact"];
$fullname = $_SESSION["t_fullname"];
$shopname = $_SESSION["shopname"];

// $birthday = $_SESSION["t_birthday"];
$s_type = $_SESSION["sell"];
$approval_status = "Yes";
$admin_email = "kartstreak123@gmail.com";
$subject = "Email Activation";
$msg = "<html>
<head>
</head>
<body>
<h1>Hello Admin</h1>
<h2>Trader Information: </h2>
<p>Trader Name: $fullname<br>
Trader Email : $email<br>
Trader Contact : $contact<br>
Shop Name : $shopname<br>
What he want to sell : $s_type
</p>
<h3>Hello Admin Do you want to give approval for following shop?</h3>
<p>Please click below to activate your account : http://localhost/Kart_Register/approve.php?Approval=$approval_status </p>

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
    $_SESSION["activate_account"] = "Your activation is under process for $email";
    header("location: Add_shop.php");
}
?>