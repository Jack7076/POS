    <!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS Direct - Prozel Cloud Solutions</title>
    <link rel="stylesheet" href="style/global.css" type="text/css">
    <link rel="stylesheet" href="style/fa/all.css">
</head>
<body>
    <div id="pos">
        <div id="nav">
            <div class="brand">POS Direct</div>
            <div class="control">
                <i class="fa fa-user"></i> Jack (jack@prozel.net)
            </div>
        </div>
        <div class="sidebar">
            <ul>
                <li><a href="#"><i class="fa fa-home"></i></a></li>
                <li><a href="#"><i class="fa fa-cash-register"></i></a></li>
                <li><a href="#"><i class="fa fa-sign-out-alt"></i></a></li>
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
                    <div class="row">
                        <div class="left">
                            Sub-Total: $<span id="sale-subtotal-tag">0.00</span> 
                        <br>
                            Tax: $<span id="sale-tax-tag">0.00</span>
                        <br>
                            Total: $<span id="sale-total-tag">0.00</span>
                        </div>
                        <div class="right"><a href="#" class="btn">Pay Now</a></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="footer">
            <p>&copy; Prozel Cloud Solutions. <?php echo date("Y"); ?>. All Rights Reserved.</p>
        </div>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script/main.js"></script>
</body>
</html>