<section id="daftarMitra" class="col-md-10 offset-md-1">
    @if(count($perusahaanAll) > 0)
    <div class="card box btn-square mt-3">
        <div class="card-body" id="daftarMitraSlide">
            @foreach($perusahaanAll as $p)
                <img @if($p->foto === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoPerusahaan/'.$p->foto) }}" alt="{{ $p->nama }}" @endif class="img-custom border imgZoom">
            @endforeach
        </div>
    </div>
    @endif
</section>
