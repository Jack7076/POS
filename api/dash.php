<?php
require_once __DIR__ . "/../php/authentication.php";
if(!hasAccess(20)){
    echo "Error: You do not have access to the Dashboard. You can request access from your supervisor.";
}else {
    // echo "Success. Authenticated, access level is above 20.";
    ?>
    <canvas id="chart"></canvas>
    <script src="script/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("chart").getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            label: "Total Sales",
            data: {
                    labels: ['26/05/19' ,'27/05/19', '28/05/19', '29/05/19'],
                    datasets: [{
                        label: "Sale Volume",
                        data: [1, 40, 20, 30],
                        backgroundColor: [
                            "rgba(0, 0, 200, 0.2)"
                        ]

                    },
                    {
                        label: "Sale Value",
                        data: [6.99, 60.99, 121.98, 209.70],
                        backgroundColor: [
                            "rgba(0, 200, 0, 0.2)"
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
    <?php
}
?>