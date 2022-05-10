<?php
include("session.php");
include("connection.php");
include("function.php");

if (($_SESSION["roles"] == 'Trader')) {

    if (isset($_POST["submit"])) {
        if (
            !empty($_POST["product_name"]) && !empty($_POST["stock"]) && !empty($_POST["category"]) && !empty($_POST["description"]) && !empty($_POST["allergy"]) && !empty($_POST["category"]) && !empty($_POST["minimum"]) && !empty($_POST["maximum"]) && !empty($_POST["price"]) && !empty($_FILES['file']['name'])
        ) {

            // echo 'ye';
            // exit;
            // // && !empty($_POST["image"])
            $p_name = $_POST["product_name"];
            $stock = $_POST["stock"];
            $price = $_POST["price"];
            $details = $_POST["description"];
            $allergy = $_POST["allergy"];
            // $cat = $_POST["category"];
            $min = $_POST["minimum"];
            $max = $_POST["maximum"];
            // $image = $_POST["image"];
            $status = 0;
            $f_cat_key = $_POST["category"];
            $p_name = validate_product_name($conn, $p_name);

            $image = $_FILES['file']['name'];
            $file = "images/";
            $file_locs = $file . basename($_FILES["file"]["name"]);
            $file_extension = strtolower(pathinfo($file_locs, PATHINFO_EXTENSION));
            $ext_arr = array("jpg", "jpeg", "png", "gif", "svg");


            if (in_array($file_extension, $ext_arr)) {

                if (move_uploaded_file($_FILES['file']['tmp_name'], $file . $image)) {
                    if (!empty($p_name)) {
                        $f_shop_key = f_key_shop($conn);
                        $sql = oci_parse($conn, "INSERT INTO PRODUCT(PRODUCT_NAME,PRODUCT_IN_STOCK,PRODUCT_DETAILS,PRODUCT_PRICE,PRODUCT_STATUS,PRODUCT_ALLERGY_INFO,MAXIMUM_QUANTITY,MINIMUM_QUANTITY,PRODUCT_IMAGE,FK1_SHOP_ID,FK2_CATEGORY_ID)
   VALUES(:product_name,:stock,:details,:price,:statuss,:allergy,:maxx,:minn,:images,:FK1_SHOP_ID,:FK2_CATEGORY_ID)");

                        oci_bind_by_name($sql, ':product_name', $p_name);
                        // oci_bind_by_name($sql, ':product_category', $cat);
                        oci_bind_by_name($sql, ':stock', $stock);
                        oci_bind_by_name($sql, ':details', $details);
                        oci_bind_by_name($sql, ':price', $price);
                        oci_bind_by_name($sql, ':statuss', $status);
                        oci_bind_by_name($sql, ':allergy', $allergy);
                        oci_bind_by_name($sql, ':maxx', $max);
                        oci_bind_by_name($sql, ':minn', $min);
                        oci_bind_by_name($sql, ':images', $image);
                        oci_bind_by_name($sql, ':FK1_SHOP_ID', $f_shop_key);
                        oci_bind_by_name($sql, ':FK2_CATEGORY_ID', $f_cat_key);


                        if (oci_execute($sql)) {
                            $_SESSION['p_added'] = "Product added succesfully";
                            header("Location:manage_product.php");
                        }
                    }
                }
            } else {
                $_SESSION['invalid_ext'] = "Does not support image extension";
                header("Location:add_products.php");
            }
        } else {
            $_SESSION['product_empt'] = "All field must not be empty";
            header("Location:add_products.php");
        }
    }
}
