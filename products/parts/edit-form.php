<form action="/products/handling/administration.php" method="post">
  <input hidden name="oldId" value="<?php echo $product["id"]; ?>">

  <div class="input-group">
    <span class="input-group-addon">new id</span>
    <input name="newId" type="number" min="1" class="form-control" required
     value="<?php echo $product["id"]; ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">name</span>
    <input name="name" class="form-control" required
     value="<?php echo str_replace("\"", "&quot;", $product["name"]); ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">brand</span>
    <select name="brand_id" class="form-control" required>
      <option selected value="<?php echo $product["brand_id"]; ?>">
        <?php echo $brands[$product["brand_id"]]["name"]; ?>
      </option>

      <?php
          foreach ($brands as $id => $brand) {
              if ($id != $product["brand_id"]) {
                  echo <<<EOT
                      <option value="$id">{$brand["name"]}</option>
EOT;
              }
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">color</span>
    <select name="color" class="form-control" required>
      <option selected value="<?php echo $product["color"]; ?>">
        <?php echo $product["color"]; ?>
      </option>

      <?php
          foreach ($colors as $color) {
              if ($color != $product["color"]) {
                  echo <<<EOT
                      <option value="$color">$color</option>
EOT;
              }
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">sizes (EU)</span>
    <input name="sizes" class="form-control" required
           placeholder="split sizes via whitespaces"
           pattern="[,0-9\s]{2,50}"
           value="<?php 
              foreach ($sizes[$product["id"]] as $size) {
                echo "$size ";
            }
            ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">gender</span>
    <select name="gender" class="form-control" required>
      <option selected value="<?php echo $product["gender"]; ?>">
        <?php echo $product["gender"]; ?>
      </option>

      <?php
          foreach ($genders as $gender) {
              if ($gender != $product["gender"]) {
                  echo <<<EOT
                      <option value="$gender">$gender</option>
EOT;
              }
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">age</span>
    <select name="age" class="form-control" required>
      <option selected value="<?php echo $product["age"]; ?>">
        <?php echo $product["age"]; ?>
      </option>

      <?php
          foreach ($ages as $age) {
              if ($age != $product["age"]) {
                  echo <<<EOT
                      <option value="$age">$age</option>
EOT;
              }
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">price</span>
    <input name="price" type="number" min="1" class="form-control" required
     value="<?php echo $product["price"]; ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">discount</span>
    <input name="discount" type="number" min="0" class="form-control" required
     value="<?php echo $product["discount"]; ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">stock</span>
    <input name="stock" type="number" min="1" class="form-control" required
     value="<?php echo $product["stock"]; ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">manufacturer</span>
    <input name="manufacturer" class="form-control" required
     value="<?php echo $product["manufacturer"]; ?>">
  </div>

  <p class="text-center">
    <button name="edit" type="submit" class="btn btn-default">
      edit
    </button>
  </p>
</form>