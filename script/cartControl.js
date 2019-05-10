$(document).on("click", ".price", (e) => {
    e.preventDefault();
    var el = e.toElement;
    allowEdit(el);
    $(el).focus();
});
$(document).on("focusout", ".price", (e) => {
    e.preventDefault();
    var el = e.currentTarget;
    disableEdit(el);
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
});

var allowEdit = (e) => {
    $(e).attr("contenteditable", "true")
    .addClass("bg-edit");
}
var disableEdit = (e) => {
    $(e).removeAttr("contenteditable")
    .removeClass("bg-edit");
}
var calcTotal = () => {
    var itms = $("#cart-itm-list").find("li");
    var total = 0;
    for(let i = 0; i < itms.length; i++){
        var itprice = $(itms[i]).find(".price");
        itprice = $(itprice).val();
        debugger;
        total += itprice;
        console.log(itprice);
    }

    return total;
}