<?php
require_once __DIR__ . "/../../php/authentication.php";

$query = $conn->prepare("SELECT * FROM sales WHERE saledate BETWEEN :from AND :to;");
$to = date("Y-m-d", strtotime("+1 day"));
$from = date("Y-m-d", strtotime("-5 day"));
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
        $sales++;
    }
}
?>
<div class="dash-reports">
    <div class="dash-gross-profit">
        <div class="dash-box">
            <i class="fal fa-usd-circle"></i>
            <span class="title">Gross Profit:</span> <span class="value">$<?php echo $salevalue; ?></span>
        </div>
    </div>
    <div class="dash-total-sales">
        <div class="dash-box">
            <i class="fal fa-receipt"></i>
            <span class="title">Sales:</span> <span class="value"><?php echo $sales; ?></span>
        </div>
    </div>
    <div class="dash-users">
        <div class="dash-box">
            <i class="fal fa-users"></i>
            <span class="title">Users:</span> <span class="value"><?php echo countUsers(); ?></span>
        </div>
    </div>
</div>

<div class="chart-holder">
    <canvas id="dash-sales-chart"></canvas>
</div>

<script>
        var ctx = document.getElementById("dash-sales-chart").getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            label: "Total Sales",
            data: {
                    labels: ['26/05/19' ,'27/05/19', '28/05/19', '29/05/19'],
                    datasets: [{
                        label: "Sale Volume",
                        data: [1, 40, 20, 30],
                        backgroundColor: [
                            "#e4f1fe"
                        ]

                    },
                    {
                        label: "Sale Value",
                        data: [6.99, 60.99, 121.98, 209.70],
                        backgroundColor: [
                            "#34495e"
                        ]
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
            
        });
    </script>