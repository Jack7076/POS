$(document).on("click", "#subAuthForm", (e) => {
    e.preventDefault();
    el = e.currentTarget;
    var username = $("#frmUsrname").val();
    var password = $("#frmPass").val();
    var data = {
        username,
        password,
        authenticate: true
    }
    console.log({data});
    $.ajax({
        url: "login.php",
        type: "post",
        data,
        success: (data) => {
            console.log(data);
            if(data === "success"){
                $("#sucessBox").html("Successfuly authenticated. Redirecting ...");
                $("#successBox").show();
                $("#errorBox").hide();
                window.location = "index.php";
            } else {
                switch(data){
                    case "invalid":
                        $("#errorBox").html("Your username and/or password is invalid!");
                        $("#errorBox").show();
                        $("#successBox").hide();
                        break;
                    default:
                        $("#errorBox").html("An unknown error has occured! Please try again.");
                        $("#errorBox").show();
                        $("#successBox").hide();
                }

            }
        }
    });
});
$(document).on("keydown", "*", (e) => {
    if(e.originalEvent.key == "Enter"){
        e.preventDefault();
        $("#subAuthForm").click();
    }
});