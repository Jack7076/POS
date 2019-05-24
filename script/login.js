$(document).on("click", "#subAuthForm", (e) => {
    e.preventDefault();
    el = e.currentTarget;
    var pin = $("#currentCode").html();
    authenticate(pin);
});

var authenticate = (pin) => {
    var data = {
        pin,
        authenticate: true
    }
    console.log({data});
    $.ajax({
        url: "login",
        type: "post",
        data,
        success: (data) => {
            console.log(data);
            if(data === "success"){
                window.location = "index";
            } else {
                switch(data){
                    case "invalid":
                        $("#errorBoxLoginAuth").html("Error: Your PIN was invalid!");
                        break;
                    default:
                        $("#errorBoxLoginAuth").html("Error: An unknown error has occured! Please try again.");
                }

            }
        }
    });
}
var keyPressed = false;
$(document).on("click", ".keypad-number", (e) => {
    var num = $(e.currentTarget).html();
    var attr = $(e.currentTarget).attr("data-control");
    if(typeof attr !== typeof undefined && attr !== false){
        num = attr;
    }
    addNum(num);
});

$(document).on("keydown", "*", (e) => {
    e.preventDefault();
    if(keyPressed){
        return;
    }
    keyPressed = true;
    var num = e.key;
    addNum(num);
});

$(document).on("keyup", "*", (e) => {
    keyPressed = false;
});

var addNum = (num) => {
    if(num == "Backspace"){
        $("#currentCode").html($("#currentCode").html().slice(0, -1));
    }
    num = filter(num);

    $("#currentCode").html(
        $("#currentCode").html() + num
    );
    
    var leng = $("#currentCode").html().length;
    var code = $("#currentCode").html();

    if(leng >= 4){
        $("#currentCode").html("");
        authenticate(code);
    }
}

var filter = (str) => {
    // Remove all characters except for 0 to 9.
    str = str.replace(/[^0-9]/g, "");
    return str;
}