<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/products/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | products administration</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">products table</h1>

        <p class="text-right">
          <a class="btn btn-default" href="/products/add.php">add product</a>
        </p>

        <?php
            $attribute = key($_GET);
            $value = $_GET[$attribute];

            $products = getFilteredProducts($attribute, $value);
            $sizes = getSizes($products);
            closeConnection();
            displayProductsTable($products, $sizes);
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php require "$root/parts/footer.html"; ?>
  
  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>