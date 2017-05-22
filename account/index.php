<!DOCTYPE html>

<html>

<head>
  <?php include "../parts/head.html"; ?>
  <title>themarket | personal</title>
</head>

<body>
  <a name="home"></a>
  <?php include "../parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-lg-offset-4
                  col-md-6 col-md-offset-3
                  col-sm-12 col-xs-12">
        <?php
            if (isset($_COOKIE['authorized'])) {
                include "parts/account.php";
            } else {
                include "parts/sign-in-form.php";
            }
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php include "../parts/footer.html"; ?>
  
  <?php include "../parts/scripts.html"; ?>
</body>

</html>