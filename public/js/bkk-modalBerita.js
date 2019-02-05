function smart_substr(s, n) {
    var m,
        r = /<([^>\s]*)[^>]*>/g,
        stack = [],
        lasti = 0,
        result = "";

    //for each tag, while we don't have enough characters
    while ((m = r.exec(s)) && n) {
        //get the text substring between the last tag and this one
        var temp = s.substring(lasti, m.index).substr(0, n);
        //append to the result and count the number of characters added
        result += temp;
        n -= temp.length;
        lasti = r.lastIndex;

        if (n) {
            result += m[0];
            if (m[1].indexOf("/") === 0) {
                //if this is a closing tag, than pop the stack (does not account for bad html)
                stack.pop();
            } else if (m[1].lastIndexOf("/") !== m[1].length - 1) {
                //if this is not a self closing tag than push it in the stack
                stack.push(m[1]);
            }
        }
    }

    //add the remainder of the string, if needed (there are no more tags in here)
    result += s.substr(lasti, n);

    //fix the unclosed tags
    while (stack.length) {
        result += "</" + stack.pop() + ">";
    }

    return result;
}

$(".berita").on("click", function() {
    $("body").addClass("modal-open");

    let $dataBerita = JSON.parse(
        JSON.stringify(eval("(" + $(this).attr("data-berita") + ")"))
    );
    $("#judulModal").html($dataBerita.judul_berita);
    $fotoModal.attr(
        "src",
        $(this)
            .children(".leftSide")
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
    // $("#isiBerita").html(smart_substr($dataBerita.isi_berita, 300));
    $(".buttonEdit").attr("href", $(this).attr("data-edit"));
    $(".buttonHapus").attr("href", $(this).attr("data-hapus"));
    // console.log(smart_substr($dataBerita.isi_berita, 300));
    $(".modal").fadeIn(500);
});
