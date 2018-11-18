$zoom = false;
$(".loker").on("click", function() {
    $data = JSON.parse(
        JSON.stringify(eval("(" + $(this).attr("data-formodal") + ")"))
    );

    if (!$data.id_perusahaan) {
        $data.id_perusahaan = "Admin";
    } else {
        $dataPerusahaan = JSON.parse(
            JSON.stringify(eval("(" + $(this).attr("data-perusahaan") + ")"))
        );
        $data.id_perusahaan = $dataPerusahaan.nama;
    }

    $("#judulModal").html($data.judul);
    $("#brosurModal").attr(
        "src",
        $(this)
            .children("img")
            .attr("src")
    );
    $("#brosurModal").attr(
        "alt",
        $(this)
            .children("img")
            .attr("alt")
    );
    $("#persyaratanModal").html($data.persyaratan);
    $("#gajiModal").html($data.gaji);
    $("#jamKerjaModal").html($data.jam_kerja);
    $("#siapaModal").html($data.id_perusahaan);
    $("#waktuModal").html($data.created_at);
    $("#keteranganModal").html($data.keterangan_loker);
    $("#jadwalModal").html(
        $data.jadwal_tes + " | " + $data.waktu_tes + " | " + $data.tempat_tes
    );
    $("#keaktifanModal").html(
        '<span style="color: green">' + $data.status + "</span>"
    );
    $(".buttonEdit").attr("href", $(this).attr("data-edit"));
    $(".buttonDelete").attr("href", $(this).attr("data-hapus"));
    $("#jumlahPelamar").html($(this).attr("data-jumlahPelamar"));
    $(".buttonPelamar").attr("href", $(this).attr("data-pelamar"));
    $("#bidangModal").html($data.bidang_pekerjaan);

    console.log($data);

    $("body").addClass("modal-open");
    $("#modalLoker").fadeIn(500);
});

$("#brosurModal").on("click", function() {
    if (!$zoom) {
        $("#brosurModalContainer").addClass("imgModalZoom");
        $(this).addClass("imgModalFull");
        $zoom = true;
    } else {
        $("#brosurModalContainer").removeClass("imgModalZoom");
        $(this).removeClass("imgModalFull");
        $zoom = false;
    }
});

$(".close").on("click", function() {
    $("body").removeClass("modal-open");
    $("#brosurModalContainer").removeClass("imgModalZoom");
    $("#brosurModal").removeClass("imgModalFull");
    $zoom = false;
    $("#modalLoker").fadeOut(500);
});
