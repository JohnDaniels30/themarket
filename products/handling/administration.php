<?php

/*
 * THERE IS NO DATA VALIDATION BEFORE ADDING/UPDATING
 */

$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php"; 

function addProduct($product)
{
    global $conn;

    $sql = "INSERT INTO products 
            (name, brand_id, color, price, stock, gender, age, manufacturer)
            VALUES ('{$product["name"]}',   {$product["brand_id"]}, 
                    '{$product["color"]}',  {$product["price"]},
                    {$product["stock"]},    '{$product["gender"]}',
                    '{$product["age"]}',    '{$product["manufacturer"]}')";
    $conn->query($sql);

    $id = $conn->insert_id;
    $sizes = explode(" ", $product["sizes"]);

    foreach ($sizes as $size) {
        $sql = "INSERT INTO product_size (product_id, size)
                VALUES ($id, $size)";
        $conn->query($sql);
    }

    $conn->close();
}

function editProduct($oldId, $newId, $product)
{
    global $conn;

    $sql = "UPDATE products 
            SET id=$newId,
                name='{$product["name"]}',
                brand_id='{$product["brand_id"]}',
                color='{$product["color"]}',
                price='{$product["price"]}',
                discount='{$product["discount"]}',
                stock='{$product["stock"]}',
                gender='{$product["gender"]}',
                age='{$product["age"]}',
                manufacturer='{$product["manufacturer"]}'
            WHERE id=$oldId";
    $conn->query($sql);

    $sql = "DELETE FROM product_size WHERE product_id='$oldId'";
    $conn->query($sql);

    $sizes = explode(" ", $product["sizes"]);

    foreach ($sizes as $size) {
        $sql = "INSERT INTO product_size (product_id, size)
                VALUES ($newId, $size)";
        $conn->query($sql);
    }

    $conn->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // add record
    if (isset($_POST["add"])) {
        addProduct($_POST);
        header("Location: /products/products-records.php");
        exit();
    }

    // update record
    if (isset($_POST["edit"])) {
        editProduct($_POST["oldId"], $_POST["newId"], $_POST);
        header("Location: /products/products-records.php");
        exit();
    }
}