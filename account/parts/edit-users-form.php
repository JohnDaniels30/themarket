<div class="row">
  <div class="col-lg-6">
    <form action="handling/users.php" method="post">
      <div class="input-group">
        <input name="id" type="number" min="1" class="form-control" required>
        <span class="input-group-btn">
          <button name="delete_user" class="btn btn-default" type="submit">delete user</button>
        </span>
      </div>
    </form>
  </div>

  <div class="col-lg-6">
    <form action="handling/users.php" method="post">
      <div class="input-group">
        <input name="id" type="number" min="1" class="form-control" required>
        <span class="input-group-btn">
          <button name="change_user_status" class="btn btn-default" type="submit">change status</button>
        </span>
      </div>
    </form>
  </div>
</div>