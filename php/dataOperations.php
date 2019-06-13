<?php
require_once __DIR__ . "/database.php";

function saleData($from, $to){
    global $conn;
    $query = $conn->prepare("SELECT * FROM sales WHERE saledate BETWEEN :from AND :to;");
    $to = date("Y-m-d", strtotime($to));
    $from = date("Y-m-d", strtotime($from));
    $query->execute([
    "from" => $from,
    "to"   => $to
    ]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $salevalue = 0;
    $sales = 0;
    foreach ($results as $sale) {
        $products = json_decode($sale['products'], true);
        foreach ($products as $item) {
            $price = filterToNumber($item['price']);
            $val = $price * filterToNumber($item['quant']);
            $salevalue += $val;
        }
        $sales++;
    }
    $salevalue = number_format((float)$salevalue, 2, '.', '');

    $newRes = [];
    foreach ($results as $sale) {
        array_push($sale, ["jsdate" => date("Y-m-d", strtotime($sale['saledate']))]);
        array_push($newRes, $sale);
    }

    $parse = [
        "totalValue" => $salevalue,
        "sales" => $newRes,
        "totalsales" => $sales,
    ];

    return $parse;
}