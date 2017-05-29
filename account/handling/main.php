<?php

/**
 * isAdmin($login) ALLOWS HACKERS TO FALSIFY THEIR COOKIES 
 * AND GET ADMINISTRATOR PRIVILEGES
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function isAdmin($login)
{
    global $conn;

    $sql = "SELECT * FROM users 
            WHERE login='$login' AND status='admin'";
    $result = $conn->query($sql);

    return ($result->num_rows == 0) ? false : true;
}

function getUsers($attribute = null, $value = null)
{
    global $conn;
    $users = [];

    if (!empty($attribute) && !empty($value)) {
        $sql = "SELECT * FROM users WHERE $attribute='$value'";
    } else {
        $sql = "SELECT * FROM users";
    }

    $result = $conn->query($sql);

    // to associative array
    while ($user = $result->fetch_array(MYSQLI_ASSOC)) {
        $users[$user["id"]] = $user;
    }

    return $users ? $users : null;
}

function displayAdminMenu()
{
    echo '<ul>
            <li>
              <a href="/account/users-records.php">users administration</a>
            </li>
            <li>
              <a href="/products/products-groups.php">products administration</a>
            </li>
            <li>
              <a href="/brands/brands-records.php">brands administration</a>
            </li>
          </ul>';
}

function displayUsersTable($users)
{
    if (!empty($users)) {
      echo <<<EOT
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>id</th>
                  <th>login</th>
                  <th>password</th>
                  <th>status</th>
                  <th>name</th>
                  <th>email</th>
                  <th>birthdate</th>
                  <th colspan="2">operations</th>
                </tr>
              </thead>
              <tbody>
EOT;

      foreach ($users as $id => $user) {
            echo <<<EOT
              <tr>
                <td>$id</td>
                <td>{$user["login"]}</td>
                <td>{$user["password"]}</td>
                <td>{$user["status"]}</td>
                <td>{$user["name"]}</td>
                <td>{$user["email"]}</td>
                <td>{$user["birthdate"]}</td>
EOT;

            if ($user["status"] == "admin") {
              echo <<<EOT
                <td>
                  <a href="/account/edit.php?id=$id" title="set as user">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                  </a>
                </td>
EOT;
            } else {
              echo <<<EOT
                <td>
                  <a href="/account/edit.php?id=$id" title="set as admin">
                    <i class="fa fa-unlock-alt" aria-hidden="true"></i>
                  </a>
                </td>
EOT;
            }
            
            echo <<<EOT
                <td>
                  <a href="/account/delete.php?id=$id">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
EOT;
      }
      echo "</tbody></table></div>";
    } else {
      echo '<h1 class="text-center">no results</h1>';
    }
}