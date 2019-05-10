<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS Direct - Prozel Cloud Solutions</title>
    <link rel="stylesheet" href="style/global.css" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<body>
    <div id="pos">
        <div id="nav">
            <div class="brand">POS Direct</div>
            <div class="control">
                <i class="fa fa-user"></i> Jack (jack@prozel.net) <i class="fa fa-caret-down"></i>
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
            Products
        </div>
        <div class="cart">
            <div class="item-matrix">
            <h1>Cart</h1>
                <ul id="cart-itm-list">
                    <li data-itemno="1"><span class="quantity">1</span> Example Item 1 <span class="price">9.99</span></li>
                    <li data-itemno="2"><span class="quantity">1</span> Example Item 2 <span class="price">7.99</span></li>
                    <li data-itemno="3"><span class="quantity">1</span> Example Item 3 <span class="price">19.99</span></li>
                </ul>
                <div class="sale-control">
                    <div class="row">
                        <div class="left">Sub-Total: </div>
                        <div class="right"><a href="#" class="btn">Button</a></div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div id="footer">
            <p>&copy; Prozel Cloud Solutions. <?php echo date("Y"); ?>. All Rights Reserved.</p>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="script/cartControl.js"></script>
</body>
</html>