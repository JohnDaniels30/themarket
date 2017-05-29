<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/account/handling/main.php";
?>

<h1 class="text-center">personal page</h1>

<h2 class="text-center">
    <?php echo $_COOKIE['authorized']; ?>
</h2>

<ul>
  <li>
    <a href="/cart/index.php">cart</a>
  </li>
  <li>
    <a href="#">edit personal data</a>
  </li>
  <li>
    <a href="#">other stuff</a>
  </li>
</ul>

<?php
    if ( isAdmin($_COOKIE['authorized']) ) {
        displayAdminMenu();
    }
    closeConnection();
?>

<p class="text-right">
  <a href="/account/handling/sign-out.php">sign out</a>
</p>