<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/brands/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | products groups</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <h1 class="text-center">products groups</h1> 

      <p class="text-center">
        <a href="/products/products-records.php"><b>all</b></a>
      </p>

      <p class="text-center">
        <a href="/products/products-records.php?gender=men">men</a>
      </p>

      <p class="text-center">
        <a href="/products/products-records.php?gender=women">women</a>
      </p>

      <p class="text-center">
        <a href="/products/products-records.php?gender=unisex">unisex</a>
      </p>

      <p class="text-center">
        <a href="/products/products-records.php?age=kid">kids</a>
      </p>

      <p class="text-center">
        brands: 
        <?php
            $brands = getBrands();
            closeConnection();
            displayBrandsString($brands);
        ?>
      </p>
    </div><!-- /row -->
  </div><!-- /container -->

  <?php require "$root/parts/footer.html"; ?>

  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>