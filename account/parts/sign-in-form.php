<h1 class="text-center">wassup homie</h1>

<p class="text-right">
  <a href="/account/sign-up.php">create account</a>
</p>

<?php
    session_start();

    if ($_SESSION["authenticationErrMsg"]) {
        // display flash error message
        echo $_SESSION["authenticationErrMsg"];
        unset($_SESSION["authenticationErrMsg"]);
    }
?>

<form action="/account/handling/sign-in.php" method="post">
  <div class="input-group">
    <span class="input-group-addon">login</span>
    <input name="login" class="form-control" required autofocus>
  </div>

  <div class="input-group">
    <span class="input-group-addon">password</span>
    <input name="password" type="password" class="form-control" required>
  </div>

  <p class="text-center">
    <button type="submit" class="btn btn-default">
      let me in
    </button>
  </p>
</form>