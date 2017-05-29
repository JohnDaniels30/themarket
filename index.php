<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/products/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>
  
  <div class="container">
    <div class="row">
      <?php
          $products = getLatestProducts();
          $sizes = getSizes($products);
          closeConnection();
          displayProductsList($products, $sizes);
      ?>
    </div>
  </div>

  <?php require "$root/parts/footer.html"; ?>

  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>