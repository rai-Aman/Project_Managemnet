<?php
include("session.php");
include("connection.php");
include("function.php");

if (($_SESSION["roles"] == 'Trader')) {

    if (isset($_POST["add"])) {
        if (!empty($_POST["name"]) && !empty($_POST["location"]) && !empty($_POST["sell"])) {

            $role = "Trader";
            $s_name = $_POST["name"];
            $address = $_POST["location"];
            $s_type = $_POST["sell"];
            $status = "0";

            $f_key = $_SESSION["user_id"];

            $sql = "SELECT * FROM SHOP WHERE fk1_User_ID = $f_key";
            $stid = oci_parse($conn, $sql);
            if (oci_execute($stid)) {
                $result = 0;
                while (($row = oci_fetch_array($stid)) == true) {
                    ++$result;
                }
                if ($result >= 2) {
                    $_SESSION["more_shop"] = "You have already 2 shop registered.";
                    header("Location:Add_shop.php");
                }
            }

            $sql = "SELECT * FROM SHOP WHERE SHOP_NAME='$s_name'";
            $stid = oci_parse($conn, $sql);
            if (oci_execute($stid)) {
                $total_shop = 0;
                oci_free_statement($stid);
                oci_close($conn);
                if ($total_shop == 0) {
                    return $s_name;
                } else {
                    $_SESSION["Non_Repeated_Shopname"] = "Shop name already taken!!";
                    header("Location: Add_shop.php");
                }
            }

            $username =  $_SESSION["user_name"];
            $fullname =  $_SESSION["full_name"];
            // $email = $_SESSION["t_email"];
            $s_name = validate_shop($conn, $role, $s_name);
            // $f_key = $_SESSION["user_id"];
            // $shop_name = validate_shop($conn, $role, $s_name);
            if (!empty($s_name)) {
                $sql = oci_parse($conn, "INSERT INTO SHOP(SHOP_NAME,SHOP_TYPE,SHOP_ADDRESS,STATUSS,fk1_User_ID) VALUES
    (:shop_name,:shop_type,:shop_address,:statuss,:fk1_User_ID)");

                oci_bind_by_name($sql, ':shop_name', $s_name);
                oci_bind_by_name($sql, ':shop_type', $s_type);
                oci_bind_by_name($sql, ':shop_address', $address);
                oci_bind_by_name($sql, ':statuss', $status);
                oci_bind_by_name($sql, ':fk1_User_ID', $f_key);

                if (oci_execute($sql)) {
                    shop_verify_email($fullname, $username);

                    // $sql = "SELECT * FROM SHOP WHERE fk1_User_ID=$f_key";
                    // $stid = oci_parse($conn, $sql);
                    // if (oci_execute($stid)) {
                    // }
                }
            }
        }
    }
}

?>
