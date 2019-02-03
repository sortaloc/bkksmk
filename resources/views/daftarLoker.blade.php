<section id="daftarLoker" class="col-md-10 offset-md-1">
    <div class="row">
        <div class="col-lg-3">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Filter</div>

                <div class="card-body">
                    <!-- Filters -->
                    <form action="{{ route('lp') }}" method="GET">
                        <select name="bp" id="bp" class="form-control" style="width: 100%">
                            <option value="">Semua bidang pekerjaan</option>
                            @foreach ($bidangPekerjaan as $bp)
                                <option value="{{ $bp->bidang_pekerjaan }}" @if($request->input('bp') == $bp->bidang_pekerjaan) selected @endif>{{ $bp->bidang_pekerjaan }}</option>
                            @endforeach
                        </select>

                        <select name="gaji" id="gaji" class="form-control" style="width: 100%">
                            <option value="">Semua rentang gaji</option>
                            @foreach ($gaji as $g)
                                <option value="{{ $g->gaji }}" @if($request->input('gaji') == $g->gaji) selected @endif>{{ $g->gaji }}</option>
                            @endforeach
                        </select>

                        <select name="np" id="np" class="form-control" style="width: 100%">
                            <option value="">Semua perusahaan</option>
                            @foreach ($perusahaanAll as $np)
                                @if(count($np->loker) > 0)
                                    <option value="{{ $np->id_perusahaan }}" @if($request->input('np') == $np->id_perusahaan) selected @endif>{{ $np->nama }}</option>
                                @endif
                            @endforeach
                        </select>

                        <div class="btn-group btn-block">
                            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                            <button class="btn btn-primary btn-block text-left" type="submit">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card box btn-square">
                <div class="card-header text-center h3">Daftar Loker</div>

                <div class="card-body">
                    {{-- <div class="row">
                        <div class="col-lg-9">
                            <select class="form-control" style="width: 100%">
                                <option value="1">Urutkan berdasarkan tanggal dibuat</option>
                            </select>
                        </div>
                        <div class="col-lg-3">
                            <select name="" id="" class="form-control">
                                <option value="down">Descending</option>
                                <option value="up">Ascending</option>
                            </select>
                        </div>
                    </div> --}}
                    @if(count($loker) < 1)
                        <p class="text-center">Maaf, saat ini belum ada loker.</p>
                    @else
                        <div class="daftarItem">
                            @foreach($loker as $l)
                            <div class="box item loker" data-formodal="{{ $l }}" @if($l->perusahaan) data-perusahaan="{{ $l->perusahaan }}" @endif data-edit="{{ url('admin/loker/edit', base64_encode($l->id_loker)) }}" data-hapus="{{ url('admin/loker/delete', base64_encode($l->id_loker)) }}" data-pelamar="{{ url('admin/loker/daftar_pelamar', base64_encode($l->id_loker)) }}" data-jumlahPelamar="{{ count($l->lamaran) }}">
                                <img
                                    @if($l->brosur === 'nophoto.jpg')
                                        @if($l->perusahaan)
                                            @if($l->perusahaan->foto === 'nophoto.jpg')
                                                src="{{ asset('assets/images/BKKSMK Logo.png') }}"
                                                alt="bkksmk logo"
                                            @else
                                                src="{{ asset('storage/fotoPerusahaan/'.$l->perusahaan->foto) }}"
                                                alt="{{ $l->perusahaan->nama }}"
                                            @endif
                                        @else
                                            src="{{ asset('assets/images/BKKSMK Logo.png') }}"
                                            alt="bkksmk logo"
                                        @endif
                                    @else
                                        src="{{ asset('storage/brosur/'.$l->brosur) }}"
                                        alt="{{ $l->judul }}"
                                    @endif
                                    class="img-fluid"
                                >
                                <p class="text-center m-0"><small>{{ $l->judul }}</small></p>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
                {{ $loker->links() }}
            </div>
        </div>
    </div>
</section>
