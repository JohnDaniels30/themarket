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

function getFilteredProducts($attribute = null, $value = null)
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
        $sizes[$id] = [];
        $sql = "SELECT * FROM product_size WHERE product_id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sizes[$id][] = $row["size"];
            }
        }
    }

    return $sizes;
}

function displayProductsList($products, $sizes)
{
    if (!empty($products) && !empty($sizes)) {
        foreach ($products as $id => $product) {
            $price = $product["price"] * (1 - $product["discount"] / 100);
            echo <<<EOT
                <section class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <a href="/products/view.php?id=$id">
                    <img class="img-responsive" src="/img/shoes icon.png">
                </a>
                <h2 class="text-center">{$product["name"]}</h2>
                <p>Sizes: 
EOT;
            foreach ($sizes[$id] as $size) {
                echo "$size ";
            }
            echo <<<EOT
                </p>
                <p>Price: $price$</p>
                <p class="text-center">
                  <a class="btn btn-default" href="/products/view.php?id=$id">view details</a>
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
            <div class="table-responsive">
              <table class="table">
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
                <td>
EOT;
            foreach ($sizes[$id] as $size) {
                echo "$size ";
            }
            echo <<<EOT
                </td>
                <td>{$product["price"]}</td>
                <td>{$product["discount"]}</td>
                <td>{$product["stock"]}</td>
                <td>{$product["gender"]}</td>
                <td>{$product["age"]}</td>
                <td>{$product["brand_id"]}</td>
                <td>{$product["manufacturer"]}</td>
                <td>
                  <a href="/products/edit.php?id=$id">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                </td>
                <td>
                  <a href="/products/delete.php?id=$id">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
EOT;
        }
        echo "</tbody></table></div>";
    } else {
        echo '<h1 class="text-center">no results</h1>';
    }
}