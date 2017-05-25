<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/brands/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | brands administration</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">brands table</h1>

        <p class="text-right">
          <a class="btn btn-default" href="/brands/add.php">add brand</a>
        </p> 

        <?php
            $brands = getBrands();
            closeConnection();
            displayBrandsTable($brands);
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php require "$root/parts/footer.html"; ?>
  
  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>