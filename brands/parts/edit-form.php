<form action="/brands/handling/administration.php" method="post">
  <input hidden name="oldId" value="<?php echo $brand["id"]; ?>">

  <div class="input-group">
    <span class="input-group-addon">new id</span>
    <input name="newId" class="form-control" required 
           value="<?php echo $brand["id"]; ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">name</span>
    <input name="name" class="form-control" required autofocus
           value="<?php echo $brand["name"]; ?>">
  </div>

  <div class="input-group">
    <span class="input-group-addon">description</span>
    <textarea name="description" class="form-control" required><?php echo $brand["description"]; ?></textarea>
  </div>

  <p class="text-center">
    <button name="edit" type="submit" class="btn btn-default">
      edit
    </button>
  </p>
</form>