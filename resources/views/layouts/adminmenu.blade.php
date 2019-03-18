<section class="col-lg-3 mb-2" id="menu">
    <div class="card box btn-square">
        <div class="card-header h3 text-center">
            <span>Menu</span>
            <i class="fas fa-caret-up float-right bisaHover" id="menuButton"></i>
        </div>
        <div class="card-body" id="menuContent" data-toggle="show">

            <div class="btn-group btn-block adminmenu_beranda">
                <a href="{{ url('/') }}" class="btn btn-primary btn-square adminmenu_beranda" style="width: 48px"><i class="fas fa-home"></i></a>
                <a href="{{ url('/') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_beranda btn-desc">Beranda</a>
            </div>


            <div class="btn-group btn-block adminmenu_loker">
                <a href="{{ url('admin/loker/') }}" class="btn btn-primary btn-square adminmenu_loker" style="width: 48px"><i class="fas fa-briefcase"></i></a>
                <a href="{{ url('admin/loker/') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_loker btn-desc">Lowongan Kerja</a>
            </div>


            <div class="btn-group btn-block adminmenu_perusahaan">
                <a href="{{ url('admin/perusahaan') }}" class="btn btn-primary btn-square adminmenu_perusahaan" style="width: 48px"><i class="fas fa-industry"></i></a>
                <a href="{{ url('admin/perusahaan') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_perusahaan btn-desc">Perusahaan</a>
            </div>


            <div class="btn-group btn-block">
                <a href="{{ url('admin/cp') }}" class="btn btn-primary btn-square adminmenu_cp" style="width: 48px"><i class="fas fa-user"></i></a>
                <a href="{{ url('admin/cp') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_cp btn-desc">Calon Pegawai</a>
            </div>

            <div class="btn-group btn-block">
                <a href="{{ url('admin/alumni') }}" class="btn btn-primary btn-square adminmenu_alumni" style="width: 48px"><i class="fas fa-user-graduate"></i></a>
                <a href="{{ url('admin/alumni') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_alumni btn-desc">Alumni</a>
            </div>

            <div class="btn-group btn-block">
                <a href="{{ url('admin/bukutamu') }}" class="btn btn-primary btn-square adminmenu_bukutamu" style="width: 48px"><i class="fas fa-inbox"></i></a>
                <a href="{{ url('admin/bukutamu') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_bukutamu btn-desc">Buku Tamu</a>
            </div>

            <div class="btn-group btn-block">
                <a href="{{ url('admin/kegiatan') }}" class="btn btn-primary btn-square adminmenu_kegiatan" style="width: 48px"><i class="fas fa-people-carry"></i></a>
                <a href="{{ url('admin/kegiatan') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_kegiatan btn-desc">Kegiatan</a>
            </div>

            <div class="btn-group btn-block">
                <a href="{{ url('admin/berita') }}" class="btn btn-primary btn-square adminmenu_berita" style="width: 48px"><i class="fas fa-newspaper"></i></a>
                <a href="{{ url('admin/berita') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_berita btn-desc">Berita</a>
            </div>

            <div class="btn-group btn-block">
                <a href="{{ url('admin/pengaturan') }}" class="btn btn-primary btn-square adminmenu_setting" style="width: 48px"><i class="fas fa-cog"></i></a>
                <a href="{{ url('admin/pengaturan') }}" class="btn btn-primary btn-block text-left btn-square adminmenu_setting btn-desc">Pengaturan</a>
            </div>
        </div>
    </div>
</section>
