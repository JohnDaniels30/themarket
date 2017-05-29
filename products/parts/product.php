<img class="img-responsive" src="/img/shoes icon.png">

<h2 class="text-center"><?php echo $product["name"]; ?></h2>

<hr>

<form action="/cart/add.php" method="post">
  <input hidden name="id" value="<?php echo $product["id"]; ?>">
  <div class="row flex-container">
    <div class="col-xs-6">
      <h3 class="text-center">
        <?php
            echo $product["price"] * (1 - $product["discount"] / 100) . "$";
            if ($product["discount"]) {
                echo " <b>(- {$product["discount"]}%)</b>";
            }
        ?>
      </h3>
      
      <h4 class="text-center">sizes:
<?php
foreach ($sizes[$product["id"]] as $i => $size) {
    if ($i == 0) {
      echo "<input type=\"radio\" name=\"size\" value=\"$size\" checked> $size ";
    } else {
      echo "<input type=\"radio\" name=\"size\" value=\"$size\"> $size ";
    }
}
?>
      </h4>
    </div>

    <button type="submit" class="col-xs-6 btn btn-default purchase">BUY</button>
  </div>
</form>

<hr>

<ul>
  <li>color: 
    <a href="<?php echo "/products/index.php?color={$product["color"]}"; ?>">
      <?php echo $product["color"]; ?>
    </a>
  </li>
  <li>gender: 
    <a href="<?php echo "/products/index.php?gender={$product["gender"]}"; ?>">
      <?php echo $product["gender"]; ?>
    </a>
  </li>
  <li>age: 
    <a href="<?php echo "/products/index.php?age={$product["age"]}"; ?>">
      <?php echo $product["age"]; ?>
    </a>
  </li>
  <li>manufacturer: 
    <a href="<?php echo "/products/index.php?manufacturer={$product["manufacturer"]}"; ?>">
        <?php echo $product["manufacturer"]; ?>
    </a>
  </li>
</ul>