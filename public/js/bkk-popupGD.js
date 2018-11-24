let signInWin;
let t;

$("#fakeUpload").on("click", function() {
    let pos = {
        x: 400,
        y: 250
    };
    signInWin = window.open(
        "https://accounts.google.com/signin/oauth/oauthchooseaccount?client_id=459195203069-tfcv1690vpi80jdlt22s1foqsat51kuv.apps.googleusercontent.com&as=_AysVRbMi2pIH4p_1MPhlQ&nosignup=1&destination=http%3A%2F%2Flocalhost%3A8000&approval_state=!ChQ0aUZYQXd4UE5OLWNnM0tHcmhPZBIfMDk3RWJqWnVtM2tVOEhuU1JuY2dubXB1Z3A0TmRCWQ%E2%88%99APNbktkAAAAAW_lYIaWibCzOcUvPmWQxw5gjnRb13aHV&oauthgdpr=1&xsrfsig=AHgIfE8Pn1TMqSRT3UIw2clJRgqj5S_IbQ&flowName=GeneralOAuthFlow",
        "SignIn",
        "width=780,height=410,toolbar=0,scrollbars=0,status=0,resizable=0,location=0,location=0,menuBar=0,left=" +
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
