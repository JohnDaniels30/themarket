<?php

/*
 * THIS SCRIPT DOESN'T CHECK IF THE ORDER ITEM BELONGS TO CURRENT USER ACTUALLY
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function increaseOrderItemQuantity($id)
{
    global $conn;

    $sql = "SELECT * FROM cart_product WHERE id=$id";
    $orderItem = $conn->query($sql)->fetch_assoc();
    $quantity = $orderItem["quantity"];
    $price = $orderItem["total_price"] / $quantity;

    $quantity++;
    $price *= $quantity;

    $sql = "UPDATE cart_product
    		SET quantity=$quantity, total_price=$price
    		WHERE id=$id";
    $conn->query($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    increaseOrderItemQuantity($_GET["id"]);
    closeConnection();
    header("Location: /cart/index.php");
    exit();
}