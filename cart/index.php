<?php 
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require "$root/cart/handling/main.php";
?>

<!DOCTYPE html>

<html>

<head>
  <?php require "$root/parts/head.html"; ?>
  <title>themarket | cart</title>
</head>

<body>
  <a name="home"></a>
  <?php require "$root/parts/navbar.php"; ?>

  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-center">personal cart</h1>

        <?php
            if (isset($_COOKIE['authorized'])) {
                $orderItems = getOrderItems($_COOKIE['authorized']);
                closeConnection();
                if (displayCartTable($orderItems)) {
                    displayPurchaseButton($orderItems);
                }
            } else {
                echo "<h3 class=\"text-center\">sign in or sign up first</h3>";
            }
        ?>
      </div>
    </div>
  </div>

  <?php require "$root/parts/footer.html"; ?>

  <?php require "$root/parts/scripts.html"; ?>
</body>

</html>