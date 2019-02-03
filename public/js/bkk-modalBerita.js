$(".berita").on("click", function() {
    $("body").addClass("modal-open");

    let $dataBerita = JSON.parse(
        JSON.stringify(eval("(" + $(this).attr("data-berita") + ")"))
    );
    $("#judulModal").html($dataBerita.judul_berita);
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
    $("#waktuModal").html($dataBerita.created_at);
    $("#penulisModal").html($dataBerita.penulis);
    $("#isiBerita").html($dataBerita.isi_berita);
    $(".buttonEdit").attr("href", $(this).attr("data-edit"));
    $(".buttonHapus").attr("href", $(this).attr("data-hapus"));

    $(".modal").fadeIn(500);
});
