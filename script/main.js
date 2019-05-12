var cart = $("#cart-itm-list");

$(document).ready(() => {
    setTotal();
});

$(document).on("click", ".price", (e) => {
    e.preventDefault();
    var el = e.toElement;
    allowEdit(el);
    $(el).focus();
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

$(document).on("click", ".item-name", (e) => {
    target = e.target;
    openModal("Edit Item", "This will allow you to edit items in the cart");
});

$(document).on("click", ".close-main-modal", (e) => {
    closeModal();
});

$(document).on("click", ".product", (e) => {
    el = e.currentTarget;
    itemid = $(el).attr("data-product-id");
    itemname = $(el).attr("data-product-name");
    itemprice = $(el).attr("data-product-price");
    addProduct("1", itemprice, itemname, itemid);
});

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
    template = template.replace("ITEMPRICE", price);
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
    $("#prim-modal .modal-main .modal-header").text(title);
    $("#prim-modal .modal-main .modal-content").text(content);
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