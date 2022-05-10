<?php
include("session.php");
include("connection.php");
include("function.php");
if (isset($_GET["id"])) {
  $p_id = $_GET["id"];

  $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = $p_id";
  $stid = oci_parse($conn, $sql);
  if (oci_execute($stid)) {
    while ($row = oci_fetch_array($stid)) {
      $p_id = $row["PRODUCT_ID"];
      $p_name = $row["PRODUCT_NAME"];
      $p_stock = $row["PRODUCT_IN_STOCK"];
      $p_desc = $row["PRODUCT_DETAILS"];
      $p_price = $row["PRODUCT_PRICE"];
      $p_allergy = $row["PRODUCT_ALLERGY_INFO"];
      $p_max = $row["MAXIMUM_QUANTITY"];
      $p_min = $row["MINIMUM_QUANTITY"];
      $p_img = $row["PRODUCT_IMAGE"];
      $cat_id = $row["FK2_CATEGORY_ID"];
    }
  }
}

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="epstyles.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <div class="container">
    <div class="title" style="color: rgb(238, 121, 43);">Manage Products</div>
    <div class="content">
      <form action="update_product_val.php" method="post" enctype='multipart/form-data'>
        <div class="user-details">
          <div class="input-box">
            <input type="hidden" name="id" value="<?php echo $p_id; ?>">
            <span class="details">Product Name</span>
            <input type="text" name="name" value="<?php echo $p_name; ?>">
          </div>
          <div class="input-box">
            <span class="details">Product Stock</span>
            <input type="text" name="stock" value="<?php echo $p_stock; ?>">
          </div>
          <div class="input-box">
            <span class="details">Product Price</span>
            <input type="text" name="price" value="<?php echo $p_price; ?>">
          </div>
          <div class="input-box">
            <span class="details">Product Allergy Information</span>
            <input type="text" name="allergy" value="<?php echo $p_allergy; ?>">
          </div>
          <div class="input-box">
            <span class="details">Product Description</span>
            <textarea name="details"><?php echo $p_desc; ?></textarea>
          </div>
          <div class="input-box">
            <span class="details">Product Minimum Quantity</span>
            <input type="text" name="min" value="<?php echo $p_min; ?>">
          </div>
          <div class="input-box">
            <span class="details">Product Maximum Quantity</span>
            <input type="text" name="max" value="<?php echo $p_max; ?>">
          </div>
          <div class="gifcontainer">
            <img src="ggi.gif" alt="Avatar" class="avatar1">
          </div>
        </div>
        <div class="product-details" style="margin-top:-5rem">
          <span class="details" style="color:rgb(236, 128, 39)">Product Category</span><br>
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
        <br>
        <div class="form-input">
          <label for="img">Select Image</label>
          <input type="file" name="file">
        </div>
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
          if (isset($_SESSION["product_overlap"])) {
            echo $_SESSION["product_overlap"];
            unset($_SESSION["product_overlap"]);
          }
          ?>
        </div>
        <div class="validation_message">
          <?php
          if (isset($_SESSION["invalid_ext"])) {
            echo $_SESSION["invalid_ext"];
            unset($_SESSION["invalid_ext"]);
          }
          ?>
        </div>

        <div class="button">
          <input type="submit" value="Update Details" name="update">
        </div>
      </form>
    </div>
  </div>

</body>

</html>