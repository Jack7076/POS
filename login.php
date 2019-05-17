<?php

if(isset($_POST['username'])){
    die("success");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authenticate - POS Direct</title>
    <link rel="stylesheet" href="style/global.css" type="text/css">
    <link rel="stylesheet" href="style/login.css" type="text/css">
    <link rel="stylesheet" href="style/fa/all.css">
</head>
<body>
    <div id="authenticate">
        <div class="wrapper">
            <h1>Authenticate</h1>

            <div class="keypad">
                <span class="currentCode" id="currentCode">****</span>
                <div class="row">
                    <span class="keypad-number">1</span>
                    <span class="keypad-number">2</span>
                    <span class="keypad-number">3</span>
                </div>
                <div class="row">
                    <span class="keypad-number">4</span>
                    <span class="keypad-number">5</span>
                    <span class="keypad-number">6</span>
                </div>
                <div class="row">
                    <span class="keypad-number">7</span>
                    <span class="keypad-number">8</span>
                    <span class="keypad-number">9</span>
                </div>
                <div class="row">
                    <span class="keypad-number keypad-spacer"></span>
                    <span class="keypad-number">0</span>
                    <span class="keypad-number"><i class="fa fa-backspace backbtn"></i></span>
                </div>
            </div>
        </div>
    </div>
    <script src="script/jquery.min.js"></script>
    <script src="script/login.js"></script>
    <script src="script/registerSW.js"></script>
</body>
</html>