<?php
include("session.php");
include("connection.php");
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    $qry_update = "update kart_user set statuss='1' where token ='$token'";
    $result_update = oci_parse($conn, $qry_update);
    
    if (oci_execute($result_update)) {
        $_SESSION["activate_account"] = "Account Activated successfully.";
        header("Location:login.php");
        echo "Account Activated successfully";
    }
}
