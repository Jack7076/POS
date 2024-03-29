<?php
require_once __DIR__ . "/php/authentication.php";

if(!hasAccess(10)){
    header("Location: login");
    die("Please login to continue.");
}

?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS Direct - Prozel Cloud Solutions</title>
    <link rel="stylesheet" href="style/global.css" type="text/css">
    <link rel="stylesheet" href="style/fa/all.css" type="text/css">
    <link rel="stylesheet" href="style/loader.css" type="text/css">
    <script src="script/registerSW.js"></script>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div id="loader-container">
    <div class="loader-pre"></div>
    </div>
    <div id="pos">
        <div id="nav">
            <div class="brand">POS Direct</div>
            <div class="control">
                <i data-function="modal-logout" class="fal fa-user"></i> <?php echo getUserData($_SESSION['ID'], "fname"); ?> (<?php echo getUserData($_SESSION['ID'], "email"); ?>)
            </div>
        </div>
        <div class="sidebar">
            <ul>
            <?php
                if(hasAccess(20)){
                    ?>                    
                    <li><a href="#dash"><i class="fal fa-home"></i></a></li>
                    <?php
                }
                ?>
                <li><a href="#sell"><i class="fal fa-cash-register"></i></a></li>
                <?php
                if(hasAccess(100)){
                    ?>
                <li><a href="#prodman"><i class="fal fa-abacus"></i></a></li>                    
                <li><a href="manage/index" class="extPageKeepAlive" target="_blank"><i class="fal fa-cog"></i></a></li>                    
                    <?php
                }
                ?>
                <li><a href="#" data-function="modal-logout"><i class="fal fa-sign-out"></i></a></li>
            </ul>
        </div>
        <div class="products">
            Loading Products ...
        </div>
        <div class="cart">
            <div class="item-matrix">
            <h1>Cart</h1>
                <ul id="cart-itm-list">

                </ul>
                <div class="sale-control">
                    <div class="prices">
                        <div class="left">
                            Sub-Total: $<span id="sale-subtotal-tag">0.00</span> 
                        <br>
                            Tax: $<span id="sale-tax-tag">0.00</span>
                        <br>
                            Total: $<span id="sale-total-tag">0.00</span>
                        </div>
                    </div>

                    <div class="transact">
                        <div class="paybtn-holder">
                            <a href="#" id="paybtn" class="btn">Pay Now</a>
                        </div>
                        <div class="clearbtn-holder">
                            <a href="#" id="clrbtn" class="btn btn-warning" data-confirm-status="0">Clear Cart</a>
                            <a href="#" id="cancelClear" class="btn hidden" style="margin-top: 15px;" data-confirm-status="0">Keep Cart</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>

        <!-- Begin - Payment Processor -->

        <div class="process hidden">
            <div class="back-to-sale process-btn" id="return-to-sale-btn">
                <i class="fal fa-arrow-circle-left"></i>
                <span>Back To Sale</span>
            </div>
            <div class="process-btn transact" data-process="card">
                <i class="fal fa-credit-card"></i>
                <span>Credit Card</span>
            </div>
            <div class="process-btn transact" data-process="cash">
                <i class="fal fa-money-bill-alt"></i>
                <span>Cash</span>
            </div>
            <div class="process-btn transact" data-process="stcred">
                <i class="fal fa-user"></i>
                <span>Store Credit</span>
            </div>
            <div class="process-btn transact" data-process="laybuy">
                <i class="fal fa-receipt"></i>
                <span>Laybuy</span>
            </div>
        </div>

        <!-- BEGIN Dashboard -->
        <div id="dashboard">
            <?php require_once __DIR__ . "/api/dash.php"; ?>
        </div>

        <div id="footer">
            <p>&copy; Prozel Cloud Solutions. <?php echo date("Y"); ?>. All Rights Reserved.</p>
        </div>
    </div>
    <div id="device-size-error">
        <i class="fa fa-exclamation-triangle warning-symbol"></i>
        Your screen is too small to fit this web application, please use a larger screen or rotate your device.
    </div>
    <div class="modal" id="prim-modal">
        <div class="modal-main">
            <div class="close close-main-modal">&times;</div>
            <h1 class="modal-header">
                Loading ...
            </h1>
            <p class="modal-content">
                Please wait while the modal loads.
            </p>
        </div>
    </div>
    <script src="script/jquery.min.js"></script>
    <script src="script/main.js"></script>
    <script src="script/loaded.js"></script>
</body>
</html>