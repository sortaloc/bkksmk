<div class="row">
    @include('layouts.cpmenu')
    <section class="col-md-9" id="dashboard">
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
    $('.cpmenu_beranda').addClass('active');
</script>
@endsection

