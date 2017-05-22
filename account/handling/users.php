<?php

require "db-connection.php";

function displayUsersTable()
{
    global $conn;

    $sql = "SELECT * FROM users";
    $users = $conn->query($sql);
    $conn->close();

    if ($users->num_rows > 0) {
      echo "<table>
              <thead>
                <tr>
                  <th>id</th>
                  <th>login</th>
                  <th>password</th>
                  <th>status</th>
                  <th>name</th>
                  <th>email</th>
                  <th>birthdate</th>
                </tr>
              </thead>
              <tbody>";

      // output data of each row
      while($row = $users->fetch_assoc()) {
          echo  "<tr>" .
                  "<td>" . $row["id"] . "</td>" .
                  "<td>" . $row["login"] . "</td>" .
                  "<td>" . $row["password"] . "</td>" .
                  "<td>" . $row["status"] . "</td>" .
                  "<td>" . $row["name"] . "</td>" .
                  "<td>" . $row["email"] . "</td>" .
                  "<td>" . $row["birthdate"] . "</td>" .
                "</tr>";
      }

      echo "</tbody></table>";
    } else {
      echo "no results";
    }
}

function deleteUser($id)
{
    global $conn;

    $sql = "DELETE FROM users WHERE id='$id'";
    $conn->query($sql);
    $conn->close();
}

function changeUserStatus($id)
{
    global $conn;

    $sql = "SELECT status FROM users WHERE id='$id'";

    if ($result = $conn->query($sql)) {
        $status = $result->fetch_object()->status;

        $sql = ($status == "user") ?
            "UPDATE users SET status='admin' WHERE id='$id'" :
            "UPDATE users SET status='user'  WHERE id='$id'";

        $conn->query($sql);
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["delete_user"])) {
        deleteUser($_POST["id"]);
        header("Location: /account/users-records.php");
        exit();
    }

    if (isset($_POST["change_user_status"])) {
        changeUserStatus($_POST["id"]);
        header("Location: /account/users-records.php");
        exit();
    }
}