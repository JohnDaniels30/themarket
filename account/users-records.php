<?php require "handling/users.php"; ?>

<!DOCTYPE html>

<html>

<head>
  <?php include "../parts/head.html"; ?>
  <title>themarket | administration</title>
</head>

<body>
  <a name="home"></a>
  <?php include "../parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-lg-offset-2
                  col-md-8 col-md-offset-2
                  col-sm-12 col-xs-12">
        <h1 class="text-center">users table</h1>

        <?php 
            displayUsersTable(); 
            include "parts/edit-users-form.php"; 
        ?>
      </div><!-- /col -->
    </div><!-- /row -->
  </div><!-- /container -->

  <?php include "../parts/footer.html"; ?>
  
  <?php include "../parts/scripts.html"; ?>
</body>

</html>