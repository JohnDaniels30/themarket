<?php
    
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function getBrand($id)
{
    global $conn;

    $sql = "SELECT * FROM brands WHERE id=$id";
    $brand = $conn->query($sql)->fetch_assoc();

    return $brand ? $brand : null;
}

function getBrands()
{
    global $conn;
    $brands = [];

    $sql = "SELECT * FROM brands";
    $result = $conn->query($sql);

    // to associative array " id => [id, name, description] "
    while ($brand = $result->fetch_array(MYSQLI_ASSOC)) {
        $brands[$brand["id"]] = $brand;
    }

    return $brands ? $brands : null;
}

function displayBrandsString($brands)
{
    global $conn;

    if (!empty($brands)) {
        foreach ($brands as $id => $brand) {
            echo <<<EOT
                <a href="/products/products-records.php?brand_id=$id">
                    {$brand["name"]} 
                </a>
EOT;
        }
    } else {
        echo '<h1 class="text-center">no results</h1>';
    }
}

function displayBrandsList($brands)
{
    global $conn;

    if (!empty($brands)) {
        foreach ($brands as $id => $brand) {
            echo <<<EOT
                <p class="text-center">
                    <a href="/products/index.php?brand_id=$id"
                       title="{$brand["description"]}">
                        {$brand["name"]}
                    </a>
                </p>
EOT;
        }
    } else {
        echo '<h1 class="text-center">no results</h1>';
    }
}

function displayBrandsTable($brands)
{
    global $conn;

    if (!empty($brands)) {
        echo <<<EOT
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th>id</th>
                    <th>name</th>
                    <th>description</th>
                    <th colspan="2">operations</th>
                  </tr>
                </thead>
                <tbody>
EOT;

        foreach ($brands as $id => $brand) {
            echo <<<EOT
              <tr>
                <td>$id</td>
                <td>{$brand["name"]}</td>
                <td>{$brand["description"]}</td>
                <td>
                  <a href="/brands/edit.php?id=$id">
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                  </a>
                </td>
                <td>
                  <a href="/brands/delete.php?id=$id">
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