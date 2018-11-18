<!-- Preview Image Modal -->
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
