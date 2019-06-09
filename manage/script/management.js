$(document).on("click", ".nav-list-item", (e) => {
    target = $(e.currentTarget)[0].target;
    e.preventDefault();
    console.log({target});
    target = target.children[0];
    $(target).click();
    console.log({target});
});