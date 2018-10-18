// Preview gambar dari file chooser.
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $("#profile-img-tag").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$(document).ready(function() {
    $("input[type=file]").change(function() {
        var fieldVal = $(this).val();

        // Change the node's value by removing the fake path (Chrome)
        fieldVal = fieldVal.replace("C:\\fakepath\\", "");

        if (fieldVal != undefined || fieldVal != "") {
            $(this)
                .next(".custom-file-label")
                .attr("data-content", fieldVal);
            $(this)
                .next(".custom-file-label")
                .text(fieldVal);
        }
    });

    // Preview Foto
    $("#brosur").change(function() {
        readURL(this);
    });

    $("#foto").change(function() {
        readURL(this);
    });

    $("#foto1").change(function() {
        readURL(this);
    });
});
