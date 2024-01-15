<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/icon-logo.png') }}" />
    <title>Dashboard</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{asset('assets/modules/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/fontawesome/css/all.min.css')}}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/datatables.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/components.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <style>
        .warning{
            background-color: rgb(255, 146, 29);
        }

        .image-preview {
            text-align: center;
            margin-top: 10px;
        }

        #previewImage {
            max-width: 100%;
            max-height: 200px;
        }

        .upload-container {
            position: relative;
        }

        .thumbnail-container {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
            /* border-radius: 50%; */
            border: 1px solid rgb(194, 194, 194);
        }

        .thumbnail-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .thumbnail-container:hover .overlay {
            opacity: 1;
        }


        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            cursor: pointer;
        }

        .profile-image-container:hover .overlay {
            opacity: 1;
        }

        .upload-button {
            padding: 100px 100px;
            margin: 5px 0 0 0;
            /* background-color: #3897f0; */
            border: none;
            border-radius: 5px;
            font-size: 20px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .upload-button .icon {
            margin-right: 8px;
        }

        #upload-input {
            display: none;
        }

        #drop-area {
            position: relative;
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        #upload-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        #fileInput {
            display: none;
        }

        #preview-container {
            margin-top: 20px;
            text-align: center;
        }

        #preview {
            max-width: 100%;
            max-height: 200px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }
        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%,-50%);
            font: 14px arial;
        }

        .tooltip-container {
            position: relative;
            display: inline-block;
        }

        .tooltip-text {
            visibility: hidden;
            width: 100px; /* Set max-width to a suitable value */
            white-space: normal; /* Allow text to wrap */
            overflow-wrap: break-word; /* Allow long words to break and wrap */
            background-color: #333;
            color: #fff;
            text-align: center;
            align-items: center;
            border-radius: 6px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Position the tooltip above the text */
            left: 50%;
            transform: translateX(-50%); /* Center the tooltip above the text */
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip-container:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        /* Responsiveness */
        @media only screen and (max-width: 600px) {
            .tooltip-text {
                width: 100%;
                margin-left: 0;
                left: 0;
                bottom: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="loading">
          <img src="{{URL::to('assets/img/loader/loading.gif')}}" width="300">
        </div>
    </div>

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg">
                <div style="background-color: rgba(0, 0, 0, 0.666); background-position: center; object-fit:fill; background-size: cover; z-index: 0; width: 100%;
                height: 130px; object-fit: cover; position: absolute; opacity: 30%;"></div>
                <img src="{{ asset('assets/img/bg/bg-admin.jpg') }}" style="background-position: center; object-fit:fill; background-size: cover; z-index: 0; width: 100%;
                height: 130px; object-fit: cover; " class="img-fluid">
            </div>

            <nav class="navbar navbar-expand-lg main-navbar">
                <div class="form-inline mr-auto">
                    <div class="text-white"><i class="fas fa-calendar"></i> {{ date('l, d F Y') }}</div>
                </div>

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{asset('assets/img/avatar/avatar-1.png')}}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->username }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="features-profile.html" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profile
                            </a>

                            <div class="dropdown-divider"></div>

                            {{-- tombol logout --}}
                            <form id="logout-form" action="{{ route('posts.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>

            </nav>

            <div class="main-sidebar sidebar-style-2">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('dashboard.index') }}"><img src="{{ asset('assets/img/logo/icon-logo.png') }}" alt="logo" class="img-fluid" width="50"> BaksoQu</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('dashboard.index') }}"><img src="{{ asset('assets/img/logo/icon-logo.png') }}" alt="logo" class="img-fluid" width="50"></a>
                    </div>

                    <ul class="sidebar-menu">
                        <li class="{{ Route::is('dashboard.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('dashboard.index') }}">
                                <i class="fas fa-fire"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="menu-header">Master Data</li>
                        <li class="{{ Route::is('kategori.index', 'kategori.create', 'kategori.edit', 'produk.index', 'produk.create', 'produk.edit') ? 'active' : '' }} dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                <i class="fas fa-columns"></i>
                                <span>Data Produk</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('kategori.index', 'kategori.create', 'kategori.edit') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('kategori.index') }}">Kategori Produk</a>
                                </li>
                                <li class="{{ Route::is('produk.index', 'produk.create', 'produk.edit') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('produk.index') }}">Master Produk</a>
                                </li>
                            </ul>
                        </li>

                        <li class="{{ Route::is('pelanggan.index', 'pelanggan.show') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('pelanggan.index') }}">
                                <i class="fas fa-user-tag"></i>
                                <span>Data Pelanggan</span>
                            </a>
                        </li>

                        <li class="menu-header">Transaksi</li>

                        <li class="{{ Route::is('transaksi.terbaru', 'transaksi.proses', 'transaksi.selesai') ? 'active' : '' }} dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="fas fa-th-large"></i>
                                <span>Pesanan Pelanggan</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('transaksi.terbaru') ? 'active' : '' }}">
                                    <a class="nav-link beep beep-sidebar" href="{{ route('transaksi.terbaru') }}">Terbaru</a>
                                </li>
                                <li class="{{ Route::is('transaksi.proses') ? 'active' : '' }}">
                                    <a class="nav-link beep beep-sidebar" href="{{ route('transaksi.proses') }}">Dalam Proses</a>
                                </li>
                                <li class="{{ Route::is('transaksi.selesai') ? 'active' : '' }}">
                                    <a class="nav-link beep beep-sidebar" href="{{ route('transaksi.selesai') }}">Pesanan Selesai</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="fas fa-money-bill-wave-alt"></i>
                                <span>Transaksi</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="nav-link" href="forms-advanced-form.html">Semua Transaksi</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="forms-editor.html">Perperiode</a>
                                </li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="far fa-file-alt"></i>
                                <span>Invoice</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="nav-link" href="forms-advanced-form.html">Semua Invoice</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="forms-editor.html">Perperiode</a>
                                </li>
                            </ul>
                        </li>


                        <li class="menu-header">Setting</li>
                        <li class="{{ Route::is('users.index', 'users.create', 'users.edit', 'users.show') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="far fa-user"></i>
                                <span>Data Users</span>
                            </a>
                        </li>

                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('body')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2023 BaksoQu</a>
                </div>
                <div class="footer-right"></div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{asset('assets/modules/jquery.min.js')}}"></script>
    <script src="{{asset('assets/modules/popper.js')}}"></script>
    <script src="{{asset('assets/modules/tooltip.js')}}"></script>
    <script src="{{asset('assets/modules/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/index.js')}}"></script>
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>
    <script src="{{asset('assets/modules/prism/prism.js')}}"></script>
    <script src="{{asset('assets/js/page/bootstrap-modal.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    @include('sweetalert::alert')
    @yield('scripts')
    <script>
        $(document).ready(function(){
            $(".preloader").fadeOut();
        })
        $(document).ready(function() {
            $('.select').select2();
        });

        CKEDITOR.replace('editor', {
            toolbar: [
                ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'],
                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                ['Undo', 'Redo', '-', 'RemoveFormat']
            ],
            removePlugins: 'image, imagecaption, imagestyle, imagetoolbar, imageupload, mediaembed, link, linkimage, linkpaste'
        });

    </script>
</body>

</html>
