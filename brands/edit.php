<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/brands/handling/main.php"; 
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | edit brand</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4
                  col-md-6 col-md-offset-3
                  col-sm-12 col-xs-12">
        <h1 class="text-center">edit brand</h1>

        <?php
            $brand = getBrand($_GET["id"]);
            closeConnection();

            require "$root/brands/parts/edit-form.php"; 
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php require "$root/parts/footer.html"; ?>
  
  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>