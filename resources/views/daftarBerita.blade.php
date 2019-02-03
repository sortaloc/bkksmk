<section id="berita" class="col-md-10 offset-md-1 my-3">
    @if(!Auth::user())
        <h1 style="border-bottom: 3px solid grey;width: fit-content;"> Daftar Berita </h1>
    @endif
    @if(count($berita) > 3)
        <div id="headline" class="mb-3">
            <div id="big" class="box">
                <p class="judulBerita"> <span class="judul">{{ str_limit($berita[0]->judul_berita, 40) }}</span> <br /> <small>{{ date_format($berita[0]->created_at, 'd M Y') }}</small></p>
                <a href="{{ url('berita', $berita[0]->slug) }}">
                    <img @if($berita[0]->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$berita[0]->foto_berita) }}" alt="{{ $berita[0]->judul_berita }}" @endif class="img-fluid"/>
                </a>

            </div>
            <div class="smallBerita box">
                <p class="judulBerita"> <span class="judul">{{ str_limit($berita[1]->judul_berita, 40) }}</span> <br /> <small>{{ date_format($berita[1]->created_at, 'd M Y') }} </small></p>
                <a href="{{ url('berita', $berita[1]->slug) }}">
                    <img @if($berita[1]->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$berita[1]->foto_berita) }}" alt="{{ $berita[1]->judul_berita }}" @endif class="img-fluid"/>
                </a>

            </div>
            <div class="smallBerita box">
                <p class="judulBerita"> <span class="judul">{{ str_limit($berita[2]->judul_berita, 40) }}</span> <br /> <small>{{ date_format($berita[2]->created_at, 'd M Y') }} </small></p>
                <a href="{{ url('berita', $berita[2]->slug) }}">
                    <img @if($berita[2]->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$berita[2]->foto_berita) }}" alt="{{ $berita[2]->judul_berita }}" @endif class="img-fluid"/>
                </a>

            </div>
        </div>

        <div id="beritaSisanya" class="mt-3">
            @for($i = 3; $i < count($berita); $i++)
                <div class="beritaSisanyaItem box">
                    <p class="judulBerita"> <span class="judul">{{ str_limit($berita[$i]->judul_berita, 31) }}</span> <br /> <small>{{ date_format($berita[$i]->created_at, 'd M Y') }} </small></p>
                    <a href="{{ url('berita', $berita[$i]->slug) }}">
                        <img @if($berita[$i]->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$berita[$i]->foto_berita) }}" alt="{{ $berita[$i]->judul_berita }}" @endif class="img-fluid"/>
                    </a>

                </div>
            @endfor
        </div>
    @else
        <div id="beritaSisanya" class="mt-3">
            @foreach($berita as $b)
                <div class="beritaSisanyaItem box">
                    <p class="judulBerita"> <span class="judul">{{ str_limit($b->judul_berita, 31) }}</span> <br /> <small>{{ date_format($b->created_at, 'd M Y') }} </small></p>
                    <a href="{{ url('berita', $b->slug) }}">
                        <img @if($b->foto_berita === 'nophoto.jpg') src="{{ asset('assets/images/nophoto.jpg') }}" alt="nophoto" @else src="{{ asset('storage/fotoBerita/'.$b->foto_berita) }}" alt="{{ $b->judul_berita }}" @endif class="img-fluid"/>
                    </a>

                </div>
            @endforeach
        </div>
    @endif
</section>