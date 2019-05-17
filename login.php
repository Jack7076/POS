<?php

if(isset($_POST['authenticate']))
    die("success");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Authenticate - POS Direct</title>
    <link rel="stylesheet" href="style/global.css" type="text/css">
</head>
<body>
    <div id="authenticate">
        <div class="wrapper">
            <h1>Authenticate</h1>
            <form type="POST" class="authenticateForm">
                <div id="errorBox"></div>
                <div id="successBox"></div>
                <input id="frmUsrname" type="text" placeholder="Username">
                <input type="password" id="frmPass" placeholder="Password">
                <input type="button" value="Login" id="subAuthForm">
            </form>
        </div>
    </div>
    <script src="script/jquery.min.js"></script>
    <script src="script/login.js"></script>
</body>
</html>