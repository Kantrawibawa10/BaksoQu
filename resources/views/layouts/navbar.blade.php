<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-white p-4 shadow">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/')}}" style="color: rgb(255, 167, 26);">
            <img src="{{ asset('assets/img/logo/icon-logo.png') }}" alt="logo" width="40"
                                class="shadow-light rounded-circle"> BaksoQu
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarmenu"
            data-toggle="collapse" data-target="#navbarmenu" aria-controls="navbarmenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarmenu">
            <div class="navbar-nav">
                <a class="nav-link {{ Route::is('home', 'produk.category', 'produk.search') ? 'text-warning' : '' }}" href="{{ route('home') }}">Produk Kami</a>
                <a class="nav-link {{ Route::is('kontak') ? 'text-warning' : '' }}" href="{{ route('kontak') }}">Kontak
                    Kami</a>
            </div>

            <ul class="navbar-nav ms-auto ml-auto">
                @guest
                <li class="nav-item">
                    <a class="nav-link btn btn-warning btn-sm text-white px-3 mb-2" href="{{ route('login') }}">
                        <i class="bi bi-person-circle"></i> {{ __('Login') }}
                    </a>
                </li>
                <span class="mx-1"></span>
                <li class="nav-item">
                    <a class="nav-link btn btn-primary btn-sm px-3 text-white" href="{{-- route('register') --}}">
                        <i class="bi bi-box-arrow-in-right"></i> {{ __('Register') }}</a>
                </li>
                @endguest

                @auth
                {{-- @php
                    $order = App\Models\Rental::where('id_pelanggan', auth()->user()->id)->where('status_rental','simpan')->first();
                    if (!empty($order)) {
                        $notif_order = App\Models\Rental::where('id_pelanggan', $order->id_pelanggan)->where('status_rental','simpan')->count();
                    } else {
                        $notif_order = '0';
                    }

                    $riwayat = App\Models\Transaction::join('tbl_rental', 'tbl_rental.id_rental', '=', 'transactions.id_rental')->where('id_pelanggan', auth()->user()->id)->first();
                    if (!empty($riwayat)) {
                        $notif_riwayat = App\Models\Transaction::join('tbl_rental', 'tbl_rental.id_rental', '=', 'transactions.id_rental')->where('id_pelanggan', $riwayat->id_pelanggan)->count();
                    } else {
                        $notif_riwayat = '0';
                    }
                @endphp --}}
                <li class="nav-item dropdown py-2">
                    <a class="nav-link dropdown-toggle" type="button" id="usersmenu" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->username }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="usersmenu">
                        <li>
                            <a class="dropdown-item" href="{{-- route('myprofile') --}}">Profile</a>
                            <a class="dropdown-item" href="{{-- route('riwayat', auth()->user()->id) --}}">Transaksi <span class="notif-riwayat">{{-- $notif_riwayat --}}</span></a>
                            <a class="dropdown-item text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }} <i class="bi bi-box-arrow-right"></i>
                            </a>
                            <form id="logout-form" action="{{ route('posts.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>

                <span class="mx-2"></span>

                <li class="nav-item py-2" style="position: relative;">
                    <a href="{{-- route('keranjang', auth()->user()->id) --}}" class="cart-container">
                        <i class="bi bi-cart-fill icon-keranjang">
                            <span class="notif-keranjang">{{-- $notif_order --}}</span>
                        </i>
                    </a>
                </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
