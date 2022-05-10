<?php
include("session.php");
include("connection.php");
if (isset($_GET["id"])) {
    $p_id = $_GET["id"];
    $sql = "DELETE FROM PRODUCT WHERE PRODUCT_ID = $p_id";
    $stid = oci_parse($conn, $sql);
    if (oci_execute($stid)) {
        $_SESSION["delete"] = "Product deleted";
        header("Location: manage_product.php");
    } else {
        $_SESSION["error"] = "Error";
        header("Location: manage_product.php");
    }
}
