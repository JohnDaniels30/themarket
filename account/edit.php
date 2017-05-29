<?php

/*
 * EDITING SO FAR SUPPORTS SWITCHING USER STATUS ONLY
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "$root/parts/db-connection.php";

function editUser($id)
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

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    editUser($_GET["id"]);
    header("Location: /account/users-records.php");
    exit();
}