<!DOCTYPE html>

<html>

<head>
  <?php include "../parts/head.html"; ?>
  <title>themarket | welcome</title>
</head>

<body>
  <a name="home"></a>
  <?php include "../parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-lg-offset-3
                  col-md-8 col-md-offset-2
                  col-sm-12 col-xs-12">
        <h1 class="text-center">well done bruh</h1>

        <p class="text-center">now you can sign in</p>

        <p class="text-center">also check out the information we know bout you <i class="fa fa-level-down" aria-hidden="true"></i></p>

        <ul id="user-info"></ul>

      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php include "../parts/footer.html"; ?>

  <?php include "../parts/scripts.html"; ?>
  <script src="../js/user-info.js"></script>
</body>

</html>