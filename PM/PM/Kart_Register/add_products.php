<?php
include("session.php");
if (empty($_SESSION["user_name"])) {
    header("Location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add products Form </title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="vendor/nouislider/nouislider.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="apstyle.css">
</head>

<body>

    <div class="main">

        <div class="container">
            <div class="signup-content">
                <div class="signup-img">
                    <img src="nt.jpg" alt="">
                    <div class="signup-img-content">
                        <label for="products" class="required">Add Products </label>

                    </div>
                </div>
                <div class="signup-form">
                    <form method="POST" class="register-form" action="add_product.php" enctype='multipart/form-data'>
                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="product_name" class="required">Product Name</label>
                                    <input type="text" name="product_name" id="product_name" />
                                </div>
                                <div class="form-input">
                                    <label for="quantity" class="required">Product Stock</label>
                                    <input type="text" name="stock" id="quantity" />
                                </div>

                                <div class="form-input">
                                    <label for="pinformation" class="required">Product Allergy Information</label>
                                    <input type="text" name="allergy" id="pinformation" style="height: 6rem;" />
                                </div>
                                <div class="form-input">
                                    <label for="description" class="required">Product Description</label>
                                    <input type="text" name="description" id="description" style="height: 10rem;" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-select">
                                    <div class="label-flex">
                                        <label for="product_name">Product Category</label>
                                    </div>
                                    <div class="select-list">
                                        <select name="category" id="product_name" style="width: 13rem; height: 2rem;">
                                            <option value="">Select a Category</option>
                                            <option value="1">Meats</option>
                                            <option value="2">Fish and sea items</option>
                                            <option value="3">Bakery Items</option>
                                            <option value="4">Delicatessen</option>
                                            <option value="5">Vegetables</option>
                                            <option value="6">Fruits</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-input">
                                    <label for="price">Product Price *</label>
                                    <input type="text" name="price" id="price" />
                                </div>
                                <!-- <div class="form-input">
                                    <label for="minimum_qty">Product Unit</label>
                                    <input type="text" name="unit" id="minimum_qty" />
                                </div> -->
                                <div class="form-input">
                                    <label for="maximum_qty">Product Minimum Quantity</label>
                                    <input type="text" name="minimum" id="maximum_qty" />
                                </div>

                                <div class="form-input">
                                    <label for="maximum_qty">Product Maximum Quantity</label>
                                    <input type="text" name="maximum" id="maximum_qty" />
                                </div>
                                <div class="form-input">
                                    <label for="img">Select Image</label>
                                    <!-- <input type="file" id="img" name="file"> -->
                                    <input type="file" id="myFile" name="file">

                                </div>
                                <div class="validation_message">
                                    <?php
                                    if (isset($_SESSION["invalid_ext"])) {
                                        echo $_SESSION["invalid_ext"];
                                        unset($_SESSION["invalid_ext"]);
                                    }
                                    ?>
                                </div>
                                <div class="gifcontainer">
                                    <img src="groc.gif" alt="Avatar" class="avatar1">
                                </div>

                            </div>
                        </div>

                        <div class="form-submit">
                            <input type="submit" value="Submit" class="submit" id="submit" name="submit" />
                            <input type="submit" value="Reset" class="submit" id="reset" name="reset" />
                        </div>

                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["p_added"])) {
                                echo $_SESSION["p_added"];
                                unset($_SESSION["p_added"]);
                            }
                            ?>
                        </div>
                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["product_empt"])) {
                                echo $_SESSION["product_empt"];
                                unset($_SESSION["product_empt"]);
                            }
                            ?>
                        </div>
                        <div class="validation_message">
                            <?php
                            if (isset($_SESSION["Non_Repeated_Product"])) {
                                echo $_SESSION["Non_Repeated_Product"];
                                unset($_SESSION["Non_Repeated_Product"]);
                            }
                            ?>
                        </div>




                    </form>
                </div>
            </div>
        </div>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/nouislider/nouislider.min.js"></script>
    <script src="vendor/wnumb/wNumb.js"></script>
    <script src="vendor/jquery-validation/dist/jquery.validate.min.js"></script>
    <script src="vendor/jquery-validation/dist/additional-methods.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>