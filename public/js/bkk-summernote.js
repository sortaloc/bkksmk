$(document).ready(() => {
    $(".summernote").summernote({
        callbacks: {
            onImageUpload: function(files) {
                for (var i = 0; i < files.length; i++){
                    sendCMSFile(files[i]);
                }
            }
        }
    });

    function sendCMSFile(file) {
        var data = new FormData();
        data.append('file', file);
        $.ajax({
            method: 'POST',
            url: '/uploadCMSFile',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: false,
            cache: false,
            processData: false,
            dataType: 'JSON',
            data: data,
            success: function (url) {
                $(".summernote").summernote('insertImage', url);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error(textStatus + " " + errorThrown);
            }
        })
    }
});
