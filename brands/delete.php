<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function deleteBrand($id)
{
    global $conn;

    $sql = "DELETE FROM brands WHERE id='$id'";
    $conn->query($sql);
    
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    deleteBrand($_GET["id"]);
    header("Location: /brands/brands-records.php");
    exit();
}