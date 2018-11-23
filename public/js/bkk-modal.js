/* Close dan Zoom di Modal */
let $zoom = false;
const $closeButton = $(".close");
const $fotoModal = $("#fotoModal");

function zoomInFotoModal($fotoModal) {
    $fotoModal.parent("#fotoModalContainer").addClass("imgModalZoom");
    $fotoModal.addClass("imgModalFull");
    $zoom = true;
}
function zoomOutFotoModal($fotoModal) {
    $fotoModal.parent("#fotoModalContainer").removeClass("imgModalZoom");
    $fotoModal.removeClass("imgModalFull");
    $zoom = false;
}
function zoomFotoModal($element) {
    $element.on("click", () => {
        $zoom ? zoomOutFotoModal($element) : zoomInFotoModal($element);
    });
}

function closeModal($element) {
    const $fotoModal = $element
        .siblings("#contentModal")
        .children("#fotoModalContainer")
        .children("#fotoModal");
    const $modal = $element.parent(".modal");

    $element.on("click", () => {
        zoomOutFotoModal($fotoModal);
        $("body").removeClass("modal-open");
        $modal.fadeOut(500);
    });
}

closeModal($closeButton);
zoomFotoModal($fotoModal);
