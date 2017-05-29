<?php
    
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "$root/parts/db-connection.php";

function getUserId($login)
{
    global $conn;

    $sql = "SELECT id FROM users WHERE login='$login'";
    $result = $conn->query($sql)->fetch_assoc();

    return $result["id"] ? $result["id"] : null;
}

function getOrderItems($login)
{
    global $conn;

    $orderItems = [];
    $userId = getUserId($login);

    if (!$userId) {
        return null;
    }

    $sql = "SELECT cart_product.id, product_id, 
                   name, size, quantity, total_price 
            FROM cart_product LEFT JOIN products 
            ON cart_product.product_id = products.id 
            WHERE user_id=$userId ORDER BY name";
    $result = $conn->query($sql);

    // to associative array
    while ($item = $result->fetch_array(MYSQLI_ASSOC)) {
        $orderItems[] = $item;
    }

    return $orderItems ? $orderItems : null;
}

function displayCartTable($orderItems)
{
    if (!empty($orderItems)) {
        echo <<<EOT
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>name</th>
                  <th>size</th>
                  <th>quantity</th>
                  <th>price</th>
                  <th colspan="3">operations</th>
                </tr>
              </thead>
              <tbody>
EOT;

        foreach ($orderItems as $item) {
            echo <<<EOT
              <tr>
                <td>{$item["name"]}</td>
                <td>{$item["size"]}</td>
                <td>{$item["quantity"]}</td>
                <td>{$item["total_price"]}</td>
                <td>
                  <a href="/cart/increase.php?id={$item["id"]}">
                    <i class="fa fa-plus" aria-hidden="true"></i>
                  </a>
                </td>
                <td>
                  <a href="/cart/decrease.php?id={$item["id"]}">
                    <i class="fa fa-minus" aria-hidden="true"></i>
                  </a>
                </td>
                <td>
                  <a href="/cart/delete.php?id={$item["id"]}">
                    <i class="fa fa-trash" aria-hidden="true"></i>
                  </a>
                </td>
              </tr>
EOT;
        }
        echo "</tbody></table></div>";
        return true;
    }

    echo '<h1 class="text-center">your cart is still empty :(</h1>';
    return false;
}

function displayPurchaseButton($orderItems)
{
    $price = 0;

    foreach ($orderItems as $item) {
        $price += $item["total_price"];
    }

    echo <<<EOT
        <form action="" method="post">
            <div class="row flex-container">
                <div class="col-lg-2 col-lg-offset-4
                            col-md-4 col-md-offset-2
                            col-sm-6 col-xs-6">
                    <h3 class="text-center">total: $price$</h3>
                </div>

                <button class="col-lg-2
                               col-md-4
                               col-sm-6 col-xs-6 btn btn-default purchase"
                type="submit">
                    BUY
                </button>
            </div>
        </form>
EOT;
}