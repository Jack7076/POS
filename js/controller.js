$('#js-required-msg').html("");
$("#nojsstyle").remove();

var currentPage = "api/index.php";
var prevPage = "api/index.php";
var loaded = false;
var contentArea = $("#app");
var navbar = $("#navbar");
var footer = $("#footer");
var burgerStatus = false;

$(document).ready(() => {
    loadpage();
});



loadpage = () => {
    if(loaded !== false){
        return;
    }
    $("head").append('<link id="globalcss" rel="stylesheet" href="style/global.css" type="text/css">');
    $("head").append('<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">');
    //$("head").append('<link rel="stylesheet" href="style/jquery-ui.css" type="text/css">');
    navbar.html(router("api/navbar.php"));
    $("#navbar").css("height", "50px");
    footer.html(router("api/footer.php"));
    var pathname = window.location.pathname;
    var origin   = window.location.origin;

    if(origin.includes("127.0.0.1") || origin.includes("localhost")){
        requesturi = pathname.substr(14);
    }
    
    try{
        requesturi = "api/" + requesturi + ".php";
        contentArea.html(router(requesturi));
    }
    catch(Exception){
        contentArea.html(router());
    }
    loaded = true;
    setTitle();
};

$(document).on("click", "a", (e) => {
    e.preventDefault();
    var target = e.currentTarget;
    var options = $(target).attr('data-send');
    if(options === "prevPage"){
        contentArea.html(router(prevPage));
        currentPage = prevPage;
        urI = currentPage.substr(4);
        urI = urI.slice(0, -4);
        pushHistory(urI);
        prevPage = "";
        return;
    }
    if(options === "burger"){
        console.log("Burger Click");
        if(!burgerStatus){
            $("#burger-times").show();
            $("#burger-bars").hide();
            $("#navbar").css("height", "300px");
        } else {
            $("#burger-bars").show();
            $("#burger-times").hide();
            $("#navbar").css("height", "50px");
        }
        burgerStatus = !burgerStatus;
        return;
    }
    prevPage = currentPage;

    hrefog = $(target).attr('href');
    href = "api/" + hrefog + ".php";
    currentPage = href;

    if(typeof options !== typeof undefined && options !== false){
        contentArea.html(router(href, options));
    } else {
        contentArea.html(router(href));
    }
    setTitle();
    pushHistory(hrefog);
})
pushHistory = (href) => {
    window.history.pushState("", document.title, href);
}
setTitle = () => {
    var titlesearch = contentArea.find("#pageTitleAttr")[0];
    if(typeof titlesearch !== typeof undefined && titlesearch !== false){         
        document.title = titlesearch.innerHTML;
    } else {
        document.title = "Prozel Cloud Solutions";
    }

    console.log("Set Title to: " + document.title);
}
router = (page = "api/index.php", data = {}) => {
    if(page === "api/.php"){
        page = "api/index.php";
    }
    console.log(`Begin Routing to: ` + page);
    response = "unset!";
    
    $.ajax({
        url: page,
        type: "post",
        data: data,
        async: false,
        success: (data) => {
            response = data;
        },
        error: (data) => {
            response = errorHandler(data);
        }
    });

    if(response === "unset!"){
        response = errorHandler();
    }

    if(response.includes("pageStyleRequest")){
        var addSheet = true;
        var StyleName = $(response).filter("#pageStyleRequest").html();
        var currentSheet = $("head").find("#requestedStyle");
        if(currentSheet.length != 0){
            if($("#requestedStyle").attr("data-sheet") === StyleName){
                addSheet = false;
            }
        }
        if(addSheet){
            loadcss = document.createElement('link');
            loadcss.setAttribute("id", "requestedStyle");
            loadcss.setAttribute("data-sheet", StyleName);
            loadcss.setAttribute("rel", "stylesheet");
            loadcss.setAttribute("type", "text/css");
            loadcss.setAttribute("href", "style/" + StyleName + ".css");
            document.getElementsByTagName("head")[0].appendChild(loadcss);
        }
    }else {
        $("#requestedStyle").remove(); 
    }
    return response;
}

errorHandler = (errorType = {}) => {

    var errorDocument;

    $.ajax({
        url: "api/error.php",
        type: "post",
        async: false,
        data: {
            errorType
        },
        success: (data) =>{
            console.log("Error Logged");
            errorDocument = data;
        },
        error: (data) => {
            console.log("Major Errors have occured!");
            document.title = "Error - Unrecoverable";
            errorDocument = "An Un-Recoverable Error has occured!";
            alert("An Un-Recoverable Error has occured!");
        }
    });

    

    return errorDocument;
}

