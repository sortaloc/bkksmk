@section('css')
<style>
    #dashboard {
        display: grid;
        grid-template-columns: repeat(2, 50%);
        grid-gap: 1em;
        height: 100%;
    }
    .responsiveChart {
        width: 100%;
        height: auto;
    }

    @media only screen and (max-width: 992px) {
        #dashboard {
            grid-template-columns: auto;
        }
    }
</style>
@endsection

<div class="row">
    @include('layouts.adminmenu')
    <section class="col-lg-9" id="dashboard">
        <div class="card box btn-square">
            <div class="card-header h3 text-center">Dashboard</div>
            <div class="card-body">
                <h1 class="text-center">Selamat Datang <br /> di BKK-SMK.</h1>
            </div>
        </div>
        <div class="card box btn-square">
            <div class="card-header h3 text-center">Status Lamaran</div>
            <div class="card-body">
                <canvas id="chartKeterima" class="responsiveChart"></canvas>
            </div>
        </div>
    </section>
</div>

@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.adminmenu_beranda').addClass('active');
    });

    let $ctx = document.getElementById('chartKeterima');
    let $data = {
        datasets: [{
            data: {!! json_encode($dataCP) !!},
            backgroundColor: ['green', 'red', 'gray']
        }],
        labels: [
            'Diterima', 'Ditolak', 'Pending'
        ],
    };
    let $options = {}
    let $chartKeterima = new Chart($ctx,{
        type: 'pie',
        data: $data,
        options: $options
    });
</script>
<script type="text/javascript" src="{{ asset('js/bkk-menuSlider.js') }}"></script>
@endsection
