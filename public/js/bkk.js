$(".jumlahPelamar").on("click", function(e) {
    e.preventDefault();
    window.location.replace($(this).attr("href"));
});

$(".deleteButton").on("click", function(e) {
    e.preventDefault();

    $(".modal").attr("style", "display: none");

    var $url = $(this).attr("href");
    swal({
        title: "Hapus data ?",
        text:
            "Jika data dihapus maka data yang bersangkutan akan ikut terhapus juga.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Okelah, hapus aja!"
    }).then(result => {
        window.location.replace($url);
    });
});
