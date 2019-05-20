<div class="search"><input type="text" id="searchbox" placeholder="Search"></div>
<?php
require_once __DIR__ . "/../php/database.php";

$query = $conn->prepare("SELECT * FROM products");

$query->execute();

$query = $query->fetchAll(PDO::FETCH_ASSOC);

foreach ($query as $product) {

    $price = $product['price'];
    $price /= 100;

    if($product['pic'] == ""){
        $product['pic'] = "placeholder.png";
    }

    echo '
        <div class="product" data-product-id="' . $product['ID'] . '" data-product-name="' . $product['name'] . '" data-product-price="' . $price . '">
            <img src="assets/' . $product['pic'] . '" alt="product Image">
            <p>' . $product['name'] . '</p>
        </div>
    ';
}
?>