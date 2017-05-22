<h1 class="text-center">personal page</h1>

<h3 class="text-center">
    <?php
        $login = $_COOKIE['authorized'];
        echo $login; 
    ?>
</h3>

<?php
    function isAdmin()
    {
        $login = $_COOKIE['authorized'];

        $servername = "localhost";
        $username = "root";
        $passwordDB = "root";
        $database = "themarket";

        // creating connection
        $conn = new mysqli($servername, $username, $passwordDB, $database);

        // checking connection
        if ($conn->connect_error) {
            return false;
        }

        $sql = "SELECT *
                FROM users 
                WHERE login='$login' AND status='admin';";

        $result = $conn->query($sql);
        $conn->close();

        return ($result->num_rows == 0) ? false : true;
    }

    function displayAdminMenu()
    {
        echo '<ul>
                <li>
                  <a href="/account/users-records.php">users records</a>
                </li>
                <li>
                  <a href="#">other things</a>
                </li>
              </ul>';
    }

    if (isAdmin()) {
        displayAdminMenu();
    }
?>

<p class="text-right">
  <a href="/account/handling/sign-out.php">sign out</a>
</p>