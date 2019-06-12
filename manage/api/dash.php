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
    $.ajax({
        url: "?api=true&request=sales-chart-data",
        type: "get",
        success: (data) => {
            console.log({data});
        },
        error: (data) => {
            alert("Failed to get Chart data! Please report this error!");
        }
    });
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
                            "#3783B4"
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