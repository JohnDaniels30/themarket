<nav class="navbar navbar-default navbar-fixed-top dark">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="/">THEMARKET</a>
    </div>

    <div class="collapse navbar-collapse" id="navbar">
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">
          go
        </button>
      </form>

      <ul class="nav navbar-nav navbar-right">
        <li><a href="/production/men.php">MEN</a></li>
        <li><a href="/production/women.php">WOMEN</a></li>
        <li><a href="/production/kids.php">KIDS</a></li>
        <li><a href="/production/brands.php">BRANDS</a></li>
        <li>
          <a href="/account/index.php">
          <?php
              if (isset($_COOKIE['authorized'])) {
                  echo "ACCOUNT";
              } else {
                  echo "SIGN IN";
              }
          ?>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>