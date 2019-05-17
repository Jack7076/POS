<?php
require_once __DIR__ . "/../php/database.php";

if(!isset($_GET['search'])){
    die("No Query Provided");
}

if($_GET['search'] == "undefined" || $_GET['search'] == ""){
    require __DIR__ . "/loadProducts.php";
    die();
}

use TeamTNT\TNTSearch\TNTSearch;

$tnt = new TNTSearch;

$tnt->loadConfig($searchConfig);
$tnt->selectIndex("default.index");
$tnt->fuzziness = true;

$fuzzy_prefix_length  = 8;
$fuzzy_max_expansions = 70;
$fuzzy_distance       = 8;

$response = $tnt->search($_GET['search'], 50);

print_r($response);

foreach ($response['ids'] as $item) {
    $query = $conn->prepare("SELECT * FROM products WHERE ID = :id");
    $query->execute([
        "id" => $item
    ]);
    $resp = $query->fetch(PDO::FETCH_ASSOC);
    echo $resp['name'];
}
var_dump($_GET['search']);