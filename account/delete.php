<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "$root/parts/db-connection.php"; 

function deleteUser($id)
{
    global $conn;

    $sql = "DELETE FROM users WHERE id='$id'";
    $conn->query($sql);

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    deleteUser($_GET["id"]);
    header("Location: /account/users-records.php");
    exit();
}