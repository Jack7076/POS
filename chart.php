<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chart Test</title>
    <link rel="stylesheet" href="style/Chart.min.css">
</head>
<body>
    <canvas id="chart"></canvas>
    <script src="script/Chart.min.js"></script>
    <script>
        var ctx = document.getElementById("chart").getContext('2d');
        var chart = new Chart(ctx, {
            type: "line",
            data: {
                    labels: ['Sales'],
                    datasets: [{
                    label: "Total Sales",
                    data: [50, 30, 100, 62, 51]
                }]
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
</body>
</html>