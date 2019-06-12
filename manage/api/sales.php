<?php
require_once __DIR__ . "/../../php/authentication.php";

if(!hasAccess(70)){
    header("location: ../index");
    die("Woops you has no access!");
}
$query = $conn->prepare("SELECT * FROM sales WHERE saledate BETWEEN :from AND :to;");
$to = date("Y-m-d", strtotime("+1 day"));
$from = date("Y-m-d", strtotime("-1002 day"));
$query->execute([
"from" => $from,
"to"   => $to
]);
$results = $query->fetchAll(PDO::FETCH_ASSOC);
$salevalue = 0;
$sales = 0;
?>
<div class="dash-reports">
    <div class="sales-date-range">
        <div class="dash-box">
            <i class="fal fa-calendar-alt"></i>
            <div class="title">Date Range</div>
            <span class="value"><?php echo date("d/m/Y" , strtotime($from)) . " to " . date("d/m/Y", strtotime($to)); ?></span>
        </div>
    </div>
</div>
<table class="sales-table">
    <thead>
        <tr>
            <td>ID</td>
            <td>Products</td>
            <td>Price</td>
            <td>Special</td>
        </tr>
    </thead>
    <tbody>
    <?php
        foreach ($results as $sale) {
            echo '<tr>';
            echo '<td>';
            echo $sale['ID'];
            echo '</td>';
            echo '<td>';
            $products = json_decode($sale['products'], true);
            $currentPrice = 0;
            foreach ($products as $item) {
                $price = filterToNumber($item['price']);
                $val = $price * filterToNumber($item['quant']);
                $salevalue += $val;
                $currentPrice += $val;
                echo $item['name'] . ", ";
            }
            echo '</td>';
            echo '<td>';
            echo "$" . number_format((float)$currentPrice, 2, '.', '');
            echo '</td>';
            echo '<td>';
            echo "None";
            echo '</td>';
            echo '</tr>';
            $sales++;
        }
    $salevalue = number_format((float)$salevalue, 2, '.', '');
    ?>
    </tbody>
</table>