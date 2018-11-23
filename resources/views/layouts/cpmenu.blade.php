<section class="col-lg-3 mb-2" id="menu">
    <div class="card box btn-square">
        <div class="card-header h3 text-center">
            <span>Menu</span>
            <i class="fas fa-caret-up float-right bisaHover" id="menuButton"></i>
        </div>
        <div class="card-body" id="menuContent" data-toggle="show">
            <div class="btn-group btn-block cpmenu_beranda">
                <a href="{{ url('/') }}" class="btn btn-primary btn-square cpmenu_beranda"><i class="fas fa-home"></i></a>
                <a href="{{ url('/') }}" class="btn btn-primary btn-block text-left btn-square cpmenu_beranda btn-desc">Beranda</a>
            </div>

            <div class="btn-group btn-block cpmenu_loker">
                <a href="{{ url('cp/loker/') }}" class="btn btn-primary btn-square cpmenu_loker"><i class="fas fa-briefcase"></i></a>
                <a href="{{ url('cp/loker/') }}" class="btn btn-primary btn-block text-left btn-square cpmenu_loker btn-desc">Lowongan Kerja</a>
            </div>

            <div class="btn-group btn-block cpmenu_loker_sudah">
                <a href="{{ url('cp/lamaran/') }}" class="btn btn-primary btn-square cpmenu_loker_sudah"><i class="fas fa-check"></i></a>
                <a href="{{ url('cp/lamaran/') }}" class="btn btn-primary btn-block text-left btn-square cpmenu_loker_sudah btn-desc">Lamaran Saya</a>
            </div>
        </div>
    </div>
</section>
