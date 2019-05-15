$(document).on("click", "#subAuthForm", (e) => {
    e.preventDefault();
    el = e.currentTarget;
    console.log({e, el});
});
$(document).on("keydown", "*", (e) => {
    if(e.originalEvent.key == "Enter"){
        e.preventDefault();
        $("#subAuthForm").click();
    }
});