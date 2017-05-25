<form action="/products/handling/administration.php" method="post">
  <div class="input-group">
    <span class="input-group-addon">name</span>
    <input name="name" class="form-control" required autofocus>
  </div>

  <div class="input-group">
    <span class="input-group-addon">brand</span>
    <select name="brand_id" class="form-control" required>
      <option value="" disabled selected>select brand</option>
      <?php
          foreach ($brands as $id => $brand) {
              echo <<<EOT
                  <option value="$id">{$brand["name"]}</option>
EOT;
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">color</span>
    <select name="color" class="form-control" required>
      <option value="" disabled selected>select color</option>
      <?php
          foreach ($colors as $color) {
              echo <<<EOT
                  <option value="$color">$color</option>
EOT;
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">sizes (EU)</span>
    <input name="sizes" class="form-control" required
           placeholder="split sizes via whitespaces"
           pattern="[,0-9\s]{2,50}">
  </div>

  <div class="input-group">
    <span class="input-group-addon">gender</span>
    <select name="gender" class="form-control" required>
      <option value="" disabled selected>select gender</option>
      <?php
          foreach ($genders as $gender) {
              echo <<<EOT
                  <option value="$gender">$gender</option>
EOT;
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">age</span>
    <select name="age" class="form-control" required>
      <option value="" disabled selected>select age</option>
      <?php
          foreach ($ages as $age) {
              echo <<<EOT
                  <option value="$age">$age</option>
EOT;
          }
      ?>
    </select>
  </div>

  <div class="input-group">
    <span class="input-group-addon">price</span>
    <input name="price" type="number" min="1" class="form-control" required>
  </div>

  <div class="input-group">
    <span class="input-group-addon">stock</span>
    <input name="stock" type="number" min="1" class="form-control" required>
  </div>

  <div class="input-group">
    <span class="input-group-addon">manufacturer</span>
    <input name="manufacturer" class="form-control" required>
  </div>

  <p class="text-center">
    <button name="add" type="submit" class="btn btn-default">
      add
    </button>
  </p>
</form>