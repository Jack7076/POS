var loadHash = () => {
    switch(window.location.hash){
        case "#stock":
            $("#content").html('<div class="loader-pre"></div>');
            $("#content").load("api/inventory");
            return;
        case "#sales":
            $("#content").html('<div class="loader-pre"></div>');
            $("#content").load("api/sales");
            return;
        case "#po":
            $("#content").html('<div class="loader-pre"></div>');
            $("#content").load("api/po");
            return;
        case "#home":
            $("#content").html('<div class="loader-pre"></div>');
            $("#content").load("api/dash");
            return;
        default:
            $("#content").html('<div class="loader-pre"></div>');
            $("#content").load("api/dash");
            return;
    }
}

$(document).ready(() => {
    loadHash();
});

$(window).on("hashchange", () => {
    loadHash();
});