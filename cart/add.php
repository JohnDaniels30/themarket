<?php

/*
 * productId and size are the global variables
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require "$root/parts/db-connection.php";

session_start();

function addProduct()
{
    global $conn, $productId, $size;

    if ( !isset($_COOKIE['authorized']) ) {
    	sendMessage("danger", "sign in or sign up first");
    }

    $userId = getUserId($_COOKIE['authorized']);

    if ( isAlreadyAdded($userId) ) {
        sendMessage("danger", "this product is already in your cart");
    }

    $price = getProductPrice();

    $sql = "INSERT INTO cart_product
    		(user_id, product_id, size, quantity, total_price)
    		VALUES ($userId, $productId, $size, 1, $price);";
    $conn->query($sql);
}

function getUserId($login)
{
	global $conn;

    $sql = "SELECT id FROM users WHERE login='$login'";
    $result = $conn->query($sql)->fetch_assoc();

    if (!$result) {
    	sendMessage("danger", "authentication failed");
    }

    return $result["id"];
}

function isAlreadyAdded($userId)
{
    global $conn, $productId, $size;

    $sql = "SELECT * FROM cart_product 
            WHERE user_id=$userId AND product_id=$productId AND size=$size";
    $result = $conn->query($sql);

    return ($result->num_rows == 0) ? false : true;
}

function getProductPrice()
{
	global $conn, $productId;

    $sql = "SELECT price, discount FROM products WHERE id=$productId";
    $result = $conn->query($sql)->fetch_assoc();

    if (!$result) {
    	sendMessage("danger", "couldn't find the product price");
    }

    return $result["price"] * (1 - $result["discount"] / 100);
}

function sendMessage($type, $text)
{
	global $productId;

	closeConnection();

    $_SESSION["cartMessage"] = 
        "<div class=\"alert alert-$type text-center\">$text</div>";
    header("Location: /products/view.php?id=$productId");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])) {
	$productId = $_POST["id"];
    $size = $_POST["size"];

    addProduct();
    sendMessage("success", "shoes have been successfully added");
}