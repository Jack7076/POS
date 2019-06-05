<?php
require_once __DIR__ . "/php/authentication.php";

if(!authenticated())
    die("This is no place for a Skid");
if(!hasAccess(1000))
    die("No access. You can request access from your supervisor.");
if(isset($_POST['calc'])){
    die(computeHash($_POST['calc']));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Controls</title>
    <script src="script/registerSW.js"></script>
</head>
<body>
    Generate Hash:
    <input type="text" id="calcHash">
    <input type="button" value="Calculate" id="calcBtn">
    <br>
    <div id="output"></div>
    <br>
    <?php 
    $query = $conn->prepare("SELECT * FROM sales WHERE saledate>= :from AND saledate< :to");
    $to = date("Y-m-d");
    $from = date("Y-m-d", strtotime("-5 day"));
    $query->execute([
        "from" => $from,
        "to"   => $to
    ]);
    $results = $query->fetchAll(PDO::FETCH_ASSOC);
    $dates = [];
    foreach ($results as $sale) {
        $date = new DateTime(strtotime($sale['saledate']));
        $saledateArrTemp = [
             $date->format("d/m/Y") => [

            ]
        ];
        array_push($dates, $saledateArrTemp);
    }

    $dates = array_unique($dates);

    foreach($dates as $date){
        
    }

    ?>
    <script src="script/jquery.min.js"></script>
    <script>
        $(document).on("keyup", "#calcHash", () => {
            var calc = $("#calcHash").val();
            $.ajax({
                url: "admin",
                type: "post",
                data: {
                    calc
                },
                success: (data) => {
                    $("#output").html(data);
                }
            });
        });
        $(document).on("click", "#calcBtn", () => {
            var calc = $("#calcHash").val();
            $.ajax({
                url: "admin",
                type: "post",
                data: {
                    calc
                },
                success: (data) => {
                    $("#output").html(data);
                }
            });
        });
    </script>
</body>
</html>