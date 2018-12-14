let signInWin;
let t;

$("#fakeUpload").on("click", function() {
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
    t = document.cookie;
    setTimeout(checkLoginStatus, 1000);
    signInWin.focus();
    return false;
});

function checkLoginStatus() {
    if (document.cookie != t) {
        signInWin.close();
        $("#realUpload").fadeIn();
        $("#fakeUpload").fadeOut();
    } else {
        setTimeout(checkLoginStatus, 1000);
    }
}
