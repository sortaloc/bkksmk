let $slideActive = 0;
let $leftArrow = $(".leftArrow");
let $rightArrow = $(".rightArrow");

$(document).ready(function() {
    $("#slide_" + $slideActive).fadeIn(0);
});

function slide($element) {
    const $jumlahKegiatan = $element.attr("data-jumlahKegiatan");
    const $arah = $element.attr("data-arah");

    $element.on("click", () => {
        $("#slide_" + $slideActive).fadeOut(500);
        if ($arah === "right") {
            if ($slideActive == $jumlahKegiatan) {
                $slideActive = 0;
            } else {
                $slideActive++;
            }
        } else if ($arah === "left") {
            if ($slideActive === 0) {
                $slideActive = $jumlahKegiatan;
            } else {
                $slideActive--;
            }
        }
        $("#slide_" + $slideActive).fadeIn(500);
    });
}

slide($leftArrow);
slide($rightArrow);
