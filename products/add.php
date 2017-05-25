<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/brands/handling/main.php";
    require "$root/products/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | add product</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4
                  col-md-6 col-md-offset-3
                  col-sm-12 col-xs-12">
        <h1 class="text-center">add new product</h1>
        <?php 
            $brands = getBrands();
            closeConnection();

            require "$root/products/parts/add-form.php"; 
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php require "$root/parts/footer.html"; ?>
  
  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>