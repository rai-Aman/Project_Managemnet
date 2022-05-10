<?php
include("session.php");
include("connection.php");
include_once("function.php");


if (isset($_POST["register"])) {

    if (!empty($_POST["email"]) && !empty($_POST["fullname"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]) && !empty($_POST["shopname"]) && !empty($_POST["sell"]) && !empty($_POST["address"]) && !empty($_POST["phone"])) {
        $role = "Trader";
        $email = $_POST["email"];
        $email = validate_email($email, $role);
        $password = $_POST["password"];
        $password = validate_password($password, $role);
        $c_password = $_POST["confirm_password"];
        $contact = $_POST["phone"];
        $shopname = $_POST["shopname"];
        $fullname = $_POST["fullname"];
        $s_type = $_POST["sell"];
        $status = "0";
        $address = $_POST["address"];

        $_SESSION["t_email"] = $email;
        $_SESSION["t_contact"] = $contact;
        $_SESSION["t_fullname"] = $fullname;
        // $_SESSION["t_birthday"] = $birthday;
        $_SESSION["sell"] = $s_type;
        $_SESSION["shopname"] = $shopname;




        $email = validate_username($conn, $role, $email);

        $username = $email;
        $_SESSION["t_username"] = $username;


        if (!empty($username)) {
            $_SESSION['token'] = bin2hex(random_bytes(16));

            $sql = oci_parse($conn, "insert into kart_user(full_name,user_name,passwords,roles,contact_no,email,token,statuss)
            values(:full_name,:user_name,:passwords,:roles,:contact,:email,:token,:statuss)");

            oci_bind_by_name($sql, ':full_name', $fullname);
            oci_bind_by_name($sql, ':user_name', $username);
            oci_bind_by_name($sql, ':passwords', $password);
            oci_bind_by_name($sql, ':roles', $role);
            oci_bind_by_name($sql, ':contact', $contact);
            oci_bind_by_name($sql, ':email', $email);
            // oci_bind_by_name($sql, ':locations', $locations);
            oci_bind_by_name($sql, ':token', $_SESSION['token']);
            oci_bind_by_name($sql, ':statuss', $status);
            if (oci_execute($sql)) {

                $f_key = f_key($conn, $_SESSION["t_username"]);
                // $_SESSION['user_id'] = $f_key;
                $shop_name = validate_shop($conn, $role, $shopname);
                if (!empty($shop_name)) {
                    $sql = oci_parse($conn, "INSERT INTO SHOP(SHOP_NAME,SHOP_TYPE,SHOP_ADDRESS,STATUSS,fk1_User_ID) VALUES
            (:shop_name,:shop_type,:shop_address,:statuss,:fk1_User_ID)");

                    oci_bind_by_name($sql, ':shop_name', $shop_name);
                    oci_bind_by_name($sql, ':shop_type', $s_type);
                    oci_bind_by_name($sql, ':shop_address', $address);
                    oci_bind_by_name($sql, ':statuss', $status);
                    oci_bind_by_name($sql, ':fk1_User_ID', $f_key);

                    if (oci_execute($sql)) {
                        trader_verify_email($fullname, $email);
                    }
                }
            }
        }
    } else {
        $_SESSION["Empty_field"] = "All field must me filled";
        header("Location:trader.php");
    }
}
?>