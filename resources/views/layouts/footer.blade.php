<footer class="bg-2 p-3 mt-3">
    <div class="row m-0 p-0">
        <div class="col-md-4 text-center">
            <h4>Lokasi</h4>
            <hr>
            {{-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.002612100019!2d107.55619391442444!3d-6.8902891950211185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68e6bd6aaaaaab%3A0xf843088e2b5bf838!2sSMK+11+Bandung!5e0!3m2!1sen!2sid!4v1517989587366" frameborder="0" class="box" style="width:100%"></iframe> --}}
        </div>
        <div class="col-md-4">
            <h4 class="text-center">Kontak</h4>
            <hr>
            <p>{{ $pengaturan->alamat }}</p>
            <p>
                <b>Telp</b> : {{ $pengaturan->telp }}<br>
                <b>Fax</b> : {{ $pengaturan->fax }}<br>
                <b>E-Mail</b> : {{ $pengaturan->email }}
            </p>
        </div>
        <div class="col-md-4">
            <h4 class="text-center">Link</h4>
            <hr>
            <a class="text-white" href="http://www.smkn11bdg.sch.id/"><img class="img-fluid" src="{{ asset('assets/images/smk11.png') }}" alt="Website SMKN 11 Bandung"/></a>
        </div>
    </div>
    <p class="text-center m-0"><i class="small">©Copyright 2018. Yanuar Wanda Putra</i></p>
</footer>
