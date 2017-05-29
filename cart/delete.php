<?php

/*
 * THIS SCRIPT DOESN'T CHECK IF THE ORDER ITEM BELONGS TO CURRENT USER ACTUALLY
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function deleteOrderItem($id)
{
    global $conn;

    $sql = "DELETE FROM cart_product WHERE id='$id'";
    $conn->query($sql);
    
    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    deleteOrderItem($_GET["id"]);
    header("Location: /cart/index.php");
    exit();
}