<div class="row">
    @include('layouts.perusahaanmenu')
    <section class="col-lg-9" id="dashboard">
        <div class="card box btn-square">
            <div class="card-header h3 text-center">Beranda</div>

            <div class="card-body pb-0">
                <h1 class="text-center">Selamat Datang di BKK-SMK.</h1>
            </div>
        </div>
    </section>
</div>

@section('js')
<script type="text/javascript">
    $('.perusahaanmenu_beranda').addClass('active');
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection
