<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/products/handling/main.php";

    $id = $_GET["id"];
    if (empty($id)) {
        header("Location: /products/index.php");
        exit();
    }

    $product = getProduct($id);
    // convert single product into array
    $sizes = getSizes([$id => $product]);
    closeConnection();
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | <?php echo $product["name"]; ?></title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3
                  col-md-8 col-md-offset-2
                  col-sm-12 col-xs-12">

        <?php
            session_start();

            if ($_SESSION["cartMessage"]) {
                // display and delete flash message
                echo $_SESSION["cartMessage"];
                unset($_SESSION["cartMessage"]);
            }
            
            include "$root/products/parts/product.php"; ?>
    </div>
  </div>

  <?php require "$root/parts/footer.html"; ?>

  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>