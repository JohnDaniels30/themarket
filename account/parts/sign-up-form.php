<h1 class="text-center">let's hang out</h1>

<p class="text-right">
  <a href="/account/index.php">sign in</a>
</p>

<?php
    session_start();

    if ($_SESSION['registrationErrMsg']) {
        // display flash error message
        echo $_SESSION['registrationErrMsg'];
        unset($_SESSION['registrationErrMsg']);
    }
?>

<form id="registration" action="/account/handling/sign-up.php" method="post">
  <div class="input-group">
    <span class="input-group-addon">name</span>
    <input name="name" class="form-control" required autofocus 
    pattern="[A-Za-zА-Яа-яЁё\s]{4,50}">
  </div>

  <div id="birthdate" class="input-group">
    <span class="input-group-addon">date of birth</span>
    <input name="birthdate" type="date" class="form-control" min="1930-01-01" required>
  </div>

  <div id="login" class="input-group">
    <span class="input-group-addon">login</span>
    <input name="login" class="form-control" required>
  </div>

  <div id="email" class="input-group">
    <span class="input-group-addon">email</span>
    <input name="email" type="email" class="form-control" required>
  </div>

  <div id="password" class="input-group">
    <span class="input-group-addon">password</span>
    <input name="password" type="password" class="form-control" 
    pattern="[A-Za-z0-9_]{6,15}" required>
  </div>

  <div id="confirmation" class="input-group">
    <span class="input-group-addon">repeat</span>
    <input name="confirmation" type="password" class="form-control"  pattern="[A-Za-z0-9_]{6,15}" required>
  </div>

  <p class="text-center">
    <button type="submit" class="btn btn-default">
      done
    </button>
  </p>
</form>