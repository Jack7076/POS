var loadHash = () => {
    switch(window.location.hash){
        case "#stock":
            $("#content").load("api/inventory");
            return;
        case "#sales":
            $("#content").load("api/sales");
            return;
        case "#po":
            $("#content").load("api/po");
            return;
        case "#home":
            $("#content").load("api/dash");
            return;
        default:
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