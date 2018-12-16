let signInWin;

$("#fakeUpload").on("click", function() {
    sessionStorage.setItem("oauthsuccess", "false");
    let pos = {
        x: 250,
        y: 250
    };

    signInWin = window.open(
        $(this).attr("data-link"),
        "SignIn",
        "width=780,height=410,toolbar=0,status=0,resizable=0,location=0,location=0,menuBar=0,left=" +
            pos.x +
            ",top=" +
            pos.y
    );
    setTimeout(checkLoginStatus, 1000);
    signInWin.focus();
    return false;
});

function checkLoginStatus() {
    console.log(localStorage.getItem("oauthsuccess"));
    if (localStorage.getItem("oauthsuccess") === "true") {
        $("#realUpload").fadeIn();
        $("#fakeUpload").fadeOut();
        localStorage.setItem("oauthsuccess", "false");
    } else {
        localStorage.setItem("oauthsuccess", "false");
        setTimeout(checkLoginStatus, 1000);
    }
}
