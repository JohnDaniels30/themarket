<?php
    
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

$colors =    ["multicolor", "white", "black", "grey", "red", 
              "green", "blue", "puprle", "yellow", "brown"];
$genders =   ["men", "women", "unisex"];
$ages =      ["adult", "kid"];

function getProduct($id)
{
    global $conn;

    $sql = "SELECT * FROM products WHERE id=$id";
    $product = $conn->query($sql)->fetch_assoc();

    return $product ? $product : null;
}

function getLatestProducts()
{
    global $conn;
    $products = [];

    $sql = "SELECT * FROM products 
            ORDER BY id DESC";
    $result = $conn->query($sql);

    // to associative array
    while ($product = $result->fetch_array(MYSQLI_ASSOC)) {
        $products[$product["id"]] = $product;
    }

    return $products ? $products : null;
}

function getProducts($attribute = null, $value = null)
{
    global $conn;
    $products = [];

    if (!empty($attribute) && !empty($value)) {
        if ($value == "men" || $value == "women") {
            $sql = "SELECT * FROM products 
                    WHERE $attribute='$value' OR gender='unisex'";
        } else {
            $sql = "SELECT * FROM products 
                    WHERE $attribute='$value'";
        }
    } else {
        $sql = "SELECT * FROM products";
    }

    $result = $conn->query($sql);

    // to associative array
    while ($product = $result->fetch_array(MYSQLI_ASSOC)) {
        $products[$product["id"]] = $product;
    }

    return $products ? $products : null;
}

function getSizes($products)
{
    global $conn;
    $sizes = [];

    foreach ($products as $id => $product) {
        $temp = "";
        $sql = "SELECT * FROM product_size WHERE product_id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $temp .= $row["size"] . " ";
            }
        } else {
            $temp = "-";
        }

        $sizes[$id] = $temp;
    }

    return $sizes;
}

function displayProductsList($products, $sizes)
{
    if (!empty($products) && !empty($sizes)) {
        foreach ($products as $id => $product) {
            echo <<<EOT
                <section class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <img class="img-responsive" src="/img/shoes icon.png">
                <h2 class="text-center">{$product["name"]}</h2>
                <p>Size: {$sizes[$id]}</p>
                <p>Price: {$product["price"]} $</p>
                <p class="text-center">
                  <a class="btn btn-default" href="/production/">view details</a>
                </p>
                </section>
EOT;
        }
    } else {
        echo '<h1 class="text-center">no results</h1>';
    }
}

function displayProductsTable($products, $sizes)
{
    if (!empty($products)) {
        echo <<<EOT
            <table>
              <thead>
                <tr>
                  <th>id</th>
                  <th>name</th>
                  <th>color</th>
                  <th>sizes</th>
                  <th>price</th>
                  <th>discount</th>
                  <th>stock</th>
                  <th>gender</th>
                  <th>age</th>
                  <th>brand id</th>
                  <th>manufacturer</th>
                  <th colspan="2">operations</th>
                </tr>
              </thead>
              <tbody>
EOT;

        foreach ($products as $id => $product) {
            echo <<<EOT
              <tr>
                <td>$id</td>
                <td>{$product["name"]}</td>
                <td>{$product["color"]}</td>
                <td>{$sizes[$id]}</td>
                <td>{$product["price"]}</td>
                <td>{$product["discount"]}</td>
                <td>{$product["stock"]}</td>
                <td>{$product["gender"]}</td>
                <td>{$product["age"]}</td>
                <td>{$product["brand_id"]}</td>
                <td>{$product["manufacturer"]}</td>
                <td><a href="/products/edit.php?id=$id">edit</a></td>
                <td><a href="/products/delete.php?id=$id">delete</a></td>
              </tr>
EOT;
        }
        echo "</tbody></table>";
    } else {
        echo '<h1 class="text-center">no results</h1>';
    }
}