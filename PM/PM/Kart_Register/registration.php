<?php
include("session.php");
include("connection.php");
include("function.php");


if (isset($_POST["register"])) {

    if (!empty($_POST["email"]) && !empty($_POST["fullname"]) && !empty($_POST["password"]) && !empty($_POST["confirm_password"]) && !empty($_POST["contact"])) {
        $role = "Customer";
        $gmail = $_POST["email"];
        $email = validate_email($gmail, $role);
       
        if(!empty($email)) 
        {
        $k_password = $_POST["password"];
        $password = validate_password($k_password, $role);
        if(!empty($password))
        {
            $contact = $_POST["contact"];
            $fullname = $_POST["fullname"];
            $status = "0";
            $locations = "ktm";
            $age = 21;
    
            $email = validate_username($conn, $role, $email);
    
            $username = $email;
            if (!empty($username)) {
                $token = bin2hex(random_bytes(16));
    
    
                $sql = oci_parse($conn, "insert into kart_user(full_name,user_name,passwords,roles,contact_no,email,token,statuss)
                values(:full_name,:user_name,:passwords,:roles,:contact,:email,:token,:statuss)");
    
                oci_bind_by_name($sql, ':full_name', $fullname);
                oci_bind_by_name($sql, ':user_name', $username);
                oci_bind_by_name($sql, ':passwords', $password);
                oci_bind_by_name($sql, ':roles', $role);
                oci_bind_by_name($sql, ':contact', $contact);
                oci_bind_by_name($sql, ':email', $email);
                // oci_bind_by_name($sql, ':locations', $locations);
                oci_bind_by_name($sql, ':statuss', $status);
                oci_bind_by_name($sql, ':token', $token);
                if (oci_execute($sql)) {
                    verify_email($fullname,$token, $email);
                }
            }
        }
        
    }
        
    
    }
         else {
        $_SESSION["empty_customer_field"] = "Every field must be filled";
        header("Location: customer.php");
    }
}
