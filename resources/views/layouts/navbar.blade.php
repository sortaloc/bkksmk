<nav class="navbar navbar-expand-lg navbar-light bg-2 navbar-laravel" id="navbar">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('assets/images/BKKSMK Logo.png') }}" alt="bkksmk logo" style="max-width: 20px;max-height: 20px">
            Bursa Kerja Khusus
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item nav-custom" id="beranda">
                        <a href="{{ url('/') }}" class="nav-link">
                            <i class="fas fa-home"></i>
                            <span>Beranda</span>
                        </a>
                    </li>

                    <li class="nav-item nav-custom" id="menuBerita">
                        <a href="{{ url('/berita') }}" class="nav-link"><i class="fas fa-newspaper"></i> Berita</a>
                    </li>

                    <li class="nav-item nav-custom" id="mitra">
                        <a href="{{ url('/mitra') }}" class="nav-link"><i class="fas fa-industry"></i> Mitra Perusahaan</a>
                    </li>

                    <li class="nav-item nav-custom mr-2" id="kontak">
                        <a href="{{ url('/kontak') }}" class="nav-link"><i class="fas fa-address-book"></i> Kontak</a>
                    </li>

                    <li class="nav-item nav-custom" id="tentang">
                        <a href="{{ url('/tentang') }}" class="nav-link"><i class="fas fa-info-circle"></i> Tentang</a>
                    </li>

                    <li class="nav-item nav-custom" id="login">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>

                    <li class="nav-item nav-custom" id="daftar">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @if(Auth::user()->id_status === 1)
                            <a class="dropdown-item" href="{{ url('admin/settings/password') }}">
                                <i class="fas fa-key"></i>
                                <span class="ml-2">{{ __('Edit Password') }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            @elseif(Auth::user()->id_status === 2)
                            <a class="dropdown-item" href="{{ url('perusahaan/settings/datadiri') }}">
                                <i class="fas fa-address-card"></i>
                                <span class="ml-2">{{ __('Edit Data Diri') }}</span>
                            </a>
                            <a class="dropdown-item" href="{{ url('perusahaan/settings/password') }}">
                                <i class="fas fa-key"></i>
                                <span class="ml-2">{{ __('Edit Password') }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            @else
                            <a class="dropdown-item" href="{{ url('cp/settings/datadiri') }}">
                                <i class="fas fa-address-card"></i>
                                <span class="ml-2">{{ __('Edit Data Diri') }}</span>
                            </a>
                            <a class="dropdown-item" href="{{ url('cp/settings/password') }}">
                                <i class="fas fa-key"></i>
                                <span class="ml-2">{{ __('Edit Password') }}</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-power-off"></i>
                                <span class="ml-2">Logout</span>
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
