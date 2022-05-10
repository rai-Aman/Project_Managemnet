<?php
include("session.php");
include("function.php");
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Manage-Product</title>
    <link rel="stylesheet" href="mpstyle.css">
</head>

<body>
    <h3 style="text-align:center;"> Manage Products </h3>
    <div class="wrapper">
        <table align="center" id="data_table" cellspacing="5" cellpadding="5" border="1">
            <tr>
                <th>Product Name </th>
                <th>Available Stock</th>
                <th>Product Price</th>
                <th>Allergy Info</th>
                <th>Max Qty</th>
                <th>Min Qty</th>
                <th>Product Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>

            <?php
            $shop_id = f_key_shop($conn);
            if (!empty($shop_id)) {
                $sql = "SELECT * FROM PRODUCT WHERE FK1_SHOP_ID	=$shop_id";
                $stid = oci_parse($conn, $sql);
                if (oci_execute($stid)) {
                    while ($row = oci_fetch_array($stid)) {
                        $p_id = $row["PRODUCT_ID"];
                        $p_name = $row["PRODUCT_NAME"];
                        $p_stock = $row["PRODUCT_IN_STOCK"];
                        // $p_desc = $row["PRODUCT_DETAILS"];
                        $p_price = $row["PRODUCT_PRICE"];
                        $p_allergy = $row["PRODUCT_ALLERGY_INFO"];
                        $p_max = $row["MAXIMUM_QUANTITY"];
                        $p_min = $row["MINIMUM_QUANTITY"];
                        $p_img = $row["PRODUCT_IMAGE"];
            ?>
                        <tr>
                            <td align="center"><?php echo $p_name; ?></td>
                            <td align="center"><?php echo $p_stock; ?></td>
                            <td align="center"><?php echo $p_price; ?></td>
                            <td align="center"><?php echo $p_allergy; ?></td>
                            <td align="center"><?php echo $p_max; ?></td>
                            <td align="center"><?php echo $p_min; ?></td>
                            <td align="center"><img src='images/<?php echo $p_img; ?>' width='80px' height='70px'></td>

                            <td><a href="edit_product.php?id=<?php echo $p_id; ?>">Edit</a></td>
                            <td><a href="delete_product.php?id=<?php echo $p_id; ?>">Delete</a></td>
                        </tr>

                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["update"])) {
                                echo $_SESSION["update"];
                                unset($_SESSION["update"]);
                            }
                            ?>
                        </div>
                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["delete"])) {
                                echo $_SESSION["delete"];
                                unset($_SESSION["delete"]);
                            }
                            ?>
                        </div>
                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["p_added"])) {
                                echo $_SESSION["p_added"];
                                unset($_SESSION["p_added"]);
                            }
                            ?>
                        </div>
            <?php
                    }
                }
            }
            ?>

            <!-- <tr id="row1">
                <td id="pname_row1"> </td>
                <td id="pprice_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td>
                    <form>
                        <button type="submit" class="edit" formaction="edit_product.php">Edit</button>
                        <button type="submit" class="delete">Delete</button>

                    </form>

                </td>
            </tr> -->
            <!-- <tr id="row1">
                <td id="pname_row1"> </td>
                <td id="pprice_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td id="pquantity_row1"> </td>
                <td>
                    <form>
                        <button type="submit" class="edit" formaction="edit_product.php">Edit</button>
                        <button type="submit" class="delete">Delete</button>

                    </form>

                </td>
            </tr> -->
        </table>
    </div>
</body>
</body>

</html>