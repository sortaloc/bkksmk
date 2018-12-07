let signInWin;
let t;

$("#fakeUpload").on("click", function() {
    let pos = {
        x: 400,
        y: 250
    };
    signInWin = window.open(
        "https://accounts.google.com/o/oauth2/v2/auth?scope=https://www.googleapis.com/auth/drive&access_type=offline&include_granted_scopes=true&state=state_parameter_passthrough_value&redirect_uri=http://localhost:8000/google/callback&response_type=code&client_id=459195203069-tfcv1690vpi80jdlt22s1foqsat51kuv.apps.googleusercontent.com",
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
