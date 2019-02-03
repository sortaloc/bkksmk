<div class="col-lg-3">
    <img id="fotoProfil" class="img-fluid box" @if ($perusahaan->foto !== 'nophoto.jpg') src="{{ asset('storage/fotoPerusahaan/'.$perusahaan->foto) }}" alt="{{ $perusahaan->nama }}" @else src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @endif>
    <section class="card box btn-square mt-3 mb-3">
        <div class="card-header text-center h3">
            <span>Menu</span>
            <i class="fas fa-caret-up float-right bisaHover" id="menuButton"></i>
        </div>
        <div class="card-body" id="menuContent" data-toggle="show">
            {{-- <div class="btn-group btn-block">
                <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary btn-square" style="width: 48px"><i class="fas fa-plus"></i></a>
                <a href="{{ url('perusahaan/loker/add') }}" class="btn btn-primary text-left btn-block btn-square btn-desc">Buat Loker</a>
            </div> --}}

            <div class="btn-group btn-block perusahaanmenu_berita">
                <a href="{{ url('/') }}" class="btn btn-primary btn-square perusahaanmenu_beranda" style="width: 48px"><i class="fas fa-home"></i></a>
                <a href="{{ url('/') }}" class="btn btn-primary text-left btn-block btn-square btn-desc perusahaanmenu_beranda">Beranda</a>
            </div>

            <div class="btn-group btn-block perusahaanmenu_berita">
                <a href="{{ url('perusahaan/berita') }}" class="btn btn-primary btn-square perusahaanmenu_berita" style="width: 48px"><i class="fas fa-newspaper"></i></a>
                <a href="{{ url('perusahaan/berita') }}" class="btn btn-primary text-left btn-block btn-square btn-desc perusahaanmenu_berita">Berita</a>
            </div>

            <div class="btn-group btn-block perusahaanmenu_loker">
                <a href="{{ url('perusahaan/loker') }}" class="btn btn-primary btn-square perusahaanmenu_loker" style="width: 48px"><i class="fas fa-briefcase"></i></a>
                <a href="{{ url('perusahaan/loker') }}" class="btn btn-primary text-left btn-block btn-square btn-desc perusahaanmenu_loker">Daftar Loker Saya</a>
            </div>
        </div>
    </section>
</div>
