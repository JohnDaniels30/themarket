<?php

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "$root/parts/db-connection.php"; 

function deleteProduct($id)
{
    global $conn;

    $sql = "DELETE FROM products WHERE id='$id'";
    $conn->query($sql);

    $sql = "DELETE FROM product_size WHERE product_id='$id'";
    $conn->query($sql);

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    deleteProduct($_GET["id"]);
    header("Location: /products/products-records.php");
    exit();
}