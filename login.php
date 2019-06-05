<?php
require_once __DIR__ . "/php/authentication.php";

if(authenticated()){
    header("Location: index");
    die("Already Authenticated");
}

if(isset($_POST['pin'])){
    if(authenticate($_POST['pin']))
        die("success");
    die("invalid");
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

            <div class="store-details">
                <h2>Prozel Systems</h2>
                <p>Please login using your provided PIN</p>
                <div class="errorBox" id="errorBoxLoginAuth"></div>
            </div>  
            <div class="keypad">
                <div class="currentCode" type="password" id="currentCode"></div>
                <div class="row border-row">
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
                    <span class="keypad-spacer"></span>
                    <span class="keypad-number">0</span>
                    <span class="keypad-number backholder" data-control="Backspace"><i class="fa fa-backspace backbtn"></i></span>
                </div>
            </div>
        </div>
    </div>
    <div id="device-size-error">
        <i class="fa fa-exclamation-triangle warning-symbol"></i>
        Your screen is too small to fit this web application, please use a larger screen or rotate your device.
    </div>
    <script src="script/jquery.min.js"></script>
    <script src="script/login.js"></script>
    <script src="script/registerSW.js"></script>
</body>
</html>