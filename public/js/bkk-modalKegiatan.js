$(".kegiatan").on("click", function() {
    $("body").addClass("modal-open");

    let $dataKegiatan = JSON.parse(
        JSON.stringify(eval("(" + $(this).attr("data-kegiatan") + ")"))
    );
    $("#judulModal").html($dataKegiatan.judul_kegiatan);
    $fotoModal.attr(
        "src",
        $(this)
            .children("img")
            .attr("src")
    );
    $fotoModal.attr(
        "alt",
        $(this)
            .children("img")
            .attr("alt")
    );
    $("#waktuModal").html($dataKegiatan.created_at);
    $("#deskripsiModal").html($dataKegiatan.deskripsi_kegiatan);
    $(".buttonEdit").attr("href", $(this).attr("data-edit"));
    $(".buttonHapus").attr("href", $(this).attr("data-hapus"));

    $(".modal").fadeIn(500);
});
