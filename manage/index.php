<?php
require_once __DIR__ . "/../php/authentication.php";

if(!hasAccess(70)){
    header("location: ../index");
    die("Woops you has no access!");
}

if(isset($_GET['api'])){
    if($_GET['api'] == "false"){
        die("Api Request without params!");
    }
    if(!isset($_GET['request'])){
        die("No data requested!");
    }

    switch($_GET['request']){
        case "sales-chart-data":
            die("Incomplete Function");
            break;
        default:
            die("No handler defined!");
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Management - POS Direct</title>
    <link rel="stylesheet" href="style/manage.css" type="text/css">
    <link rel="stylesheet" href="../style/fa/all.min.css" type="text/css">
    <link rel="stylesheet" href="../style/loader.css" type="text/css">
</head>
<body>
    <div id="loader-container">
    <div id="loader-pre"></div>
    </div>
    <div id="container">
        <div id="nav">
            <div class="brand">
                POS Direct
            </div>
            <div class="brand-subtext">
                Backend Management
            </div>

            <ul class="nav-list">
                <li class="nav-list-item"><a href="#home"><i class="fal fa-home"></i> Home</a></li>
                <li class="nav-list-item"><a href="#sales"><i class="fal fa-chart-bar"></i> Sales</a></li>
                <li class="nav-list-item"><a href="#stock"><i class="fal fa-warehouse-alt"></i> Inventory</a></li>
                <li class="nav-list-item"><a href="#po"><i class="fal fa-clipboard-list"></i> Product Orders</a></li>
                <li class="nav-list-item"><a href="../logout"><i class="fal fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>

        <div id="content">
            Loading ... Please Wait.
        </div>
    </div>
    <script src="../script/jquery.min.js"></script>
    <script src="script/management.js"></script>
    <script src="../script/Chart.min.js"></script>
    <script src="../script/loaded.js"></script>
</body>
</html>