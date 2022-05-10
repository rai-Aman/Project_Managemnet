<?php
include('session.php');
include('connection.php');

if(isset($_GET['Approval']))
{
    $approval = $_GET['Approval'];
    $token = $_SESSION['token'];
    // $f_key = $_SESSION['user_id'];


    if($approval == "Yes")
    {
        $query = "UPDATE KART_USER SET STATUSS ='1' WHERE TOKEN ='$token'";
        $stid = oci_parse($conn,$query);
    
    if(oci_execute($stid))
    {
            $sql = "select user_id from kart_user where token = '$token'";
            $result = oci_parse($conn,$sql);
            if(oci_execute($result)){
            while($row = oci_fetch_assoc($result)){
                $f_key = $row["USER_ID"];
            }
            $query = "UPDATE SHOP SET STATUSS = '1' WHERE FK1_USER_ID='$f_key'";
            $stid = oci_parse($conn,$query);
            if(oci_execute($stid))
            {
              unset( $_SESSION["activate_account"]); 
              unset( $_SESSION["t_email"]);
              unset( $_SESSION["t_contact"]);
              unset( $_SESSION["t_fullname"]);
              unset( $_SESSION["t_box"]);

              $_SESSION["activation_complete_message"]="Account activated successfully.";

              header("location:login.php");
            }
        }
        
    }
    
    }
    else{
        $_SESSION["activation_failed_message"]="Activation failed.";
                header("location:login.php");
    }

}
