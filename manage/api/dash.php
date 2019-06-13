<?php
require_once __DIR__ . "/../../php/authentication.php";

if(!hasAccess(70)){
    header("location: ../index");
    die("Woops you has no access!");
}

$data = saleData("-5 day", "+1 day");

?>
<div class="dash-reports">
    <div class="dash-gross-profit">
        <div class="dash-box">
            <i class="fal fa-usd-circle"></i>
            <span class="title">Gross Profit:</span> <span class="value">$<?php echo $data['totalValue']; ?></span>
        </div>
    </div>
    <div class="dash-total-sales">
        <div class="dash-box">
            <i class="fal fa-receipt"></i>
            <span class="title">Sales:</span> <span class="value"><?php echo $data['totalsales']; ?></span>
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
    <?php

    $date1      = date("d/m/Y", strtotime("today"));
    $date2      = date("d/m/Y", strtotime("-1 day"));
    $date3      = date("d/m/Y", strtotime("-2 day"));
    $date4      = date("d/m/Y", strtotime("-3 day"));
    $date5      = date("d/m/Y", strtotime("-4 day"));

    $date1data   = saleData( "today", "+ 1 day");
    $date2data   = saleData("-1 day", "+ 1 day");
    $date3data   = saleData("-2 day", "+ 1 day");
    $date4data   = saleData("-3 day", "+ 1 day");
    $date5data   = saleData("-4 day", "+ 1 day");
    ?>

    var day1    = '<?php echo $date1; ?>';
    var day2    = '<?php echo $date2; ?>';
    var day3    = '<?php echo $date3; ?>';
    var day4    = '<?php echo $date4; ?>';
    var day5    = '<?php echo $date5; ?>';

    var day1vol = '<?php echo $date1data['totalsales']; ?>';
    var day2vol = '<?php echo $date2data['totalsales']; ?>';
    var day3vol = '<?php echo $date3data['totalsales']; ?>';
    var day4vol = '<?php echo $date4data['totalsales']; ?>';
    var day5vol = '<?php echo $date5data['totalsales']; ?>';

    var day1val = '<?php echo $date1data['totalValue']; ?>';
    var day2val = '<?php echo $date2data['totalValue']; ?>';
    var day3val = '<?php echo $date3data['totalValue']; ?>';
    var day4val = '<?php echo $date4data['totalValue']; ?>';
    var day5val = '<?php echo $date5data['totalValue']; ?>';

    var ctx = document.getElementById("dash-sales-chart").getContext('2d');
    var chart = new Chart(ctx, {
        type: "line",
        label: "Total Sales",
        data: {
                labels: [day5 , day4, day3, day2, day1],
                datasets: [{
                    label: "Sale Volume",
                    data: [day5vol, day4vol, day3vol, day2vol, day1vol],
                    backgroundColor: [
                        "rgba(0,0,0,0)"
                    ],
                    "borderColor": [
                        "#3498db"
                    ],
                    "pointBorderColor": [
                        "#3498db"
                    ],
                    "pointBackgroundColor": [
                        "#3498db"
                    ]

                },
                {
                    label: "Sale Value",
                    data: [day5val, day4val, day3val, day2val, day1val],
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