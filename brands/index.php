<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/brands/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | brands</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <h1 class="text-center">brands</h1> 

      <?php
          $brands = getBrands();
          closeConnection();
          displayBrandsList($brands);
      ?>
    </div><!-- /row -->
  </div><!-- /container -->

  <?php require "$root/parts/footer.html"; ?>

  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>