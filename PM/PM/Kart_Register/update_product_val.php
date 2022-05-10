<?php
include("session.php");
include("connection.php");

if (isset($_POST["update"])) {
    if (!empty($_POST["id"]) && !empty($_POST["name"]) && !empty($_POST["stock"]) && !empty($_POST["price"]) && !empty($_POST["allergy"]) && !empty($_POST["details"]) && !empty($_POST["min"]) && !empty($_POST["max"])) {

        $id = $_POST["id"];
        $p_name = $_POST["name"];
        $stock = $_POST["stock"];
        $price = $_POST["price"];
        $allergy = $_POST["allergy"];
        $desc = $_POST["details"];
        $min = $_POST["min"];
        $max = $_POST["max"];
        $cat = $_POST["category"];
        $image = $_FILES['file']['name'];
        $file = "images/";
        $file_locs = $file . basename($_FILES["file"]["name"]);
        $file_extension = strtolower(pathinfo($file_locs, PATHINFO_EXTENSION));
        $ext_arr = array("jpg", "jpeg", "png", "gif", "svg");


        if (in_array($file_extension, $ext_arr)) {

            if (move_uploaded_file($_FILES['file']['tmp_name'], $file . $image)) {


                // $image = $_FILES['file']['name'];
                // $file = "images/";
                // $file_locs = $file . basename($_FILES["file"]["name"]);
                // $file_extension = strtolower(pathinfo($file_locs, PATHINFO_EXTENSION));
                // $ext_arr = array("jpg", "jpeg", "png", "gif", "svg");


                // if (in_array($file_extension, $ext_arr)) {

                //     if (move_uploaded_file($_FILES['file']['tmp_name'], $file . $image)) {

                $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_NAME='$p_name' and PRODUCT_ID <> $id";
                $stid = oci_parse($conn, $sql);
                if (oci_execute($stid)) {
                    $result = 0;
                    while (($row = oci_fetch_array($stid)) == true) {
                        ++$result;
                    }
                    if ($result == 0) {
                        $query = "UPDATE PRODUCT SET PRODUCT_NAME='$p_name', PRODUCT_IN_STOCK='$stock', PRODUCT_DETAILS='$desc', PRODUCT_PRICE=$price, PRODUCT_ALLERGY_INFO='$allergy', MAXIMUM_QUANTITY='$max', MINIMUM_QUANTITY = '$min', PRODUCT_IMAGE='$image', FK2_CATEGORY_ID=$cat WHERE PRODUCT_ID = $id";
                        $stid = oci_parse($conn, $query);
                        if (oci_execute($stid)) {

                            $_SESSION["update"] = "Product details updated successfully";
                            header("Location: manage_product.php");
                            
                        }
                    } else {
                        $_SESSION["product_overlap"] = "This product is already on sell by other trader";
                        header("Location:edit_product.php");
                    }
                }
            }
        } else {
            $_SESSION['invalid_ext'] = "Does not support image extension";
            header("Location:edit_product.php");
        }
    }
}
