<?php
    $root = realpath($_SERVER["DOCUMENT_ROOT"]);
    require_once "$root/account/handling/main.php";
?>

<h1 class="text-center">personal page</h1>

<h3 class="text-center">
    <?php echo $_COOKIE['authorized']; ?>
</h3>

<?php
    if ( isAdmin($_COOKIE['authorized']) ) {
        displayAdminMenu();
    }
    closeConnection();
?>

<p class="text-right">
  <a href="/account/handling/sign-out.php">sign out</a>
</p>