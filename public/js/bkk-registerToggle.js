let pToggle = true;
let cpToggle = false;

$("#perusahaan-btn").on("click", function() {
    if (pToggle) {
        $(this).removeClass("active");
        pToggle = false;
    } else {
        $(this).addClass("active");
        pToggle = true;

        $("#cp").removeClass("show");
        $("#cp-btn").removeClass("active");
        cpToggle = false;
    }
});

$("#cp-btn").on("click", function() {
    if (cpToggle) {
        $(this).removeClass("active");
        cpToggle = false;
    } else {
        $(this).addClass("active");
        cpToggle = true;

        $("#perusahaan").removeClass("show");
        $("#perusahaan-btn").removeClass("active");
        pToggle = false;
    }
});
