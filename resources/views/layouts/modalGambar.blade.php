<!-- Preview Image Modal -->
<style>
    .imgZoom:hover {
        opacity: 0.7;
        cursor: pointer;
        transition: 0.3s;
    }
    .modal-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }
    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }
    .modal-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }
    @keyframes zoom {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }
</style>

<div class="modal" id="myModal">
    <span class="close">&times;</span>
    <img class="modal-content" id="img01" src="" style="width: auto;max-height: 40vw"/>
    <div id="caption"></div>
</div>

<script type="text/javascript">
    //Modal Preview Image
    var modal = $('#myModal');
    var img = $('.imgZoom');
    var modalImg = $("#img01");
    var captionText = $('#caption');
    var span = $(".close");

    img.on('click', function(){
        $('body').addClass('modal-open');

        modal.fadeIn(500);
        modalImg.attr('src', $(this).attr('src'));
        captionText.html($(this).attr('alt'));
    });

    span.on('click', function(){
        $('body').removeClass('modal-open');

        modal.fadeOut(500);
    });

    modal.on('click', function(){
        $('body').removeClass('modal-open');

        modal.fadeOut(500);
    });
</script>
