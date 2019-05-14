var cart = $("#cart-itm-list");

$(document).ready(() => {
    setTotal();
    updateProducts();
    setInterval(updateProducts, 10000);
});
$(document).on("keydown", "*", (e) => {
    console.log({e});
});
$(document).on("click", ".price", (e) => {
    e.preventDefault();
    var el = e.toElement;
    allowEdit(el);
    $(el).focus();
});

$(document).on("click", "a", (e) => {
    el = $(e.currentTarget);

    if(el.attr("data-function") == "modal-logout"){
        e.preventDefault();
        openModal("Logout", "Will add logout function here.");
    }
});

$(document).on("focusout", ".price", (e) => {
    // Stop Default Action  
    e.preventDefault();
    // Get current element
    var el = e.currentTarget;
    // Stop edits to element
    disableEdit(el);
    // get price of element
    strprice = $( el ).text();
    // format price
    udateprice = formatPrice( strprice );
    // set formatted price
    $(e.currentTarget).text( udateprice );
    // calculate total and update totals
    setTotal();
});
$(document).on("click", ".quantity", (e) => {
    e.preventDefault();
    var el = e.toElement;
    allowEdit(el);
    $(el).focus();
});
$(document).on("focusout", ".quantity", (e) => {
    e.preventDefault();
    var el = e.currentTarget;
    disableEdit(el);
    setTotal();
});

$(document).on("click", ".control", (e) => {
    openModal("User Options", "Will add logout chng pass etc ...");
});

$(document).on("click", ".item-name", (e) => {
    e.preventDefault();
    target = e.target;
    itmcartid = $(target).parent().attr("data-itemno");
    openModal("Edit Item", "<div id='prim-modal-action' class='hidden edit-item-cart-id' data-action='edit-item'>"
     + itmcartid + 
     `</div>
        <div class="form-control">
        <label>Name:</label> <input class="cart-item-name">
        </div>
        <div class="form-control">
        <label>Price:</label> <input class="cart-item-price">
        </div>
        <div class="form-control">
        <label>Quantity:</label> <input class="cart-item-quanity" type="number">
        </div>
        <div class="form-control">
        <input type="button" value="Remove from cart" class="rmITMcardBTN" data-itmid="` + itmcartid + `">
        </div>
     `);
});

$(document).on("click", ".rmITMcardBTN", (e) => {
    e.preventDefault();
    el = e.currentTarget;
    removeProduct($(el).attr("data-itmid"));
    closeModal();
});

$(document).on("click", ".close-main-modal", (e) => {
    closeModal();
});

$(document).on("click", ".product", (e) => {
    e.preventDefault();
    el = e.currentTarget;
    itemid = $(el).attr("data-product-id");
    itemname = $(el).attr("data-product-name");
    itemprice = $(el).attr("data-product-price");
    addProduct("1", itemprice, itemname, itemid);
});

var removeProduct = (id) => {
    var itms = $("#cart-itm-list").find("li");

    for(let i = 0; i < itms.length; i++){
        if( $(itms[i]).attr("data-itemno") == id){
            $(itms[i]).remove();
            break;
        }
        continue;
    }
    setTotal(); 
}

var addProduct = (quantity, price, name, id) => {

    // Get all items
    var itms = $("#cart-itm-list").find("li");
    
    // found var
    var found = false;
    var elid = 0;
    // Loop all items.
    for(let i = 0; i < itms.length; i++){
        if( $( itms[i] ).attr("data-itemno") == id) {
            found = true;
            elid = i;
            break;
        }
        else {
            continue;
        }
    }
    if(found){
        var quant = $(itms[elid]).find(".quantity");
        var quantnew = parseInt(quant.html()) + 1;
        quant.html(quantnew);
        setTotal();
        return;
    }
    var template = '<li data-itemno="ITEMID"><span class="quantity">QUANTIYNUMBER</span><span class="item-name">ITEMNAME</span><span class="price">ITEMPRICE</span></li>';
    template = template.replace("QUANTIYNUMBER", quantity);
    template = template.replace("ITEMPRICE", formatPrice(price));
    template = template.replace("ITEMNAME", name);
    template = template.replace("ITEMID", id);
    cart.append(template);
    setTotal();
}

var calcTotal = () => {
    // Get all items
    var itms = $("#cart-itm-list").find("li");

    // Total Calc point
    var total = 0;
    
    // Loop all items.
    for(let i = 0; i < itms.length; i++){
        // Get price of each item.
        var itprice = $(itms[i]).find(".price");
        // get string value of the item's price
        itprice = $(itprice).html();
        // Remove $ if it exists.
        itprice = itprice.replace("$", "");
        // Convert String Price to Float Price
        itprice = parseFloat(itprice);
        // Calculate Quantity Price
        itprice = itprice * parseFloat($(itms[i]).find(".quantity").html());

        total += itprice;
    }
    total = Number(total).toFixed(2);
    return total;
}

var setTotal = (val = calcTotal()) => {
    $('#sale-total-tag').html(val);
    var tax = calcTax(val);
    var subtotal = Number(val - tax).toFixed(2);

    $('#sale-tax-tag').html(tax);
    $('#sale-subtotal-tag').html(subtotal);
}

var calcTax = (val) => {

    val /= 100;
    val *= 10;

    val = Number(val).toFixed(2);

    return val;
}

var openModal = (title, content) => {
    $("#prim-modal .modal-main .modal-header").html(title);
    $("#prim-modal .modal-main .modal-content").html(content);
    if($("#prim-modal-action").length){
        if($("#prim-modal-action").attr("data-action") == "edit-item"){

        }
    }

    
    
    $("#prim-modal").show();
}

var closeModal = () => {
    $("#prim-modal").hide();
    $("#prim-modal .modal-main .modal-header").text("Loading ...");
    $("#prim-modal .modal-main .modal-content").text("Please wait while the modal loads.");
}

var allowEdit = (e) => {
    $(e).attr("contenteditable", "true")
    .addClass("bg-edit");
}
var disableEdit = (e) => {
    $(e).removeAttr("contenteditable")
    .removeClass("bg-edit");
}
var formatPrice = (e) => {
    e = filter(e);
    e.replace("$", "");
    e = parseFloat(e);
    e = Number(e).toFixed(2);
    e = "$" + e;
    return e;
}
var filter = (str) => {
    // Remove all characters except for 0 to 9 and decimals
    str = str.replace(/[^0-9.]/g, "");
    return str;
}
var updateProducts = () => {
    $(".products").load("api/loadProducts.php");
}