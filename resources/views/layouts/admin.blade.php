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
    <link rel="stylesheet" href="{{asset('assets/modules/jqvmap/dist/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/summernote/summernote-bs4.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css')}}">
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
                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link nav-link-lg message-toggle beep"><i class="far fa-envelope"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Messages
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-message">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="assets/img/avatar/avatar-1.png" class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b>
                                        <p>Hello, Bro!</p>
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="assets/img/avatar/avatar-2.png" class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Dedik Sugiharto</b>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="assets/img/avatar/avatar-3.png" class="rounded-circle">
                                        <div class="is-online"></div>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Agung Ardiansyah</b>
                                        <p>Sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="assets/img/avatar/avatar-4.png" class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Ardian Rahardiansyah</b>
                                        <p>Duis aute irure dolor in reprehenderit in voluptate velit ess</p>
                                        <div class="time">16 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-avatar">
                                        <img alt="image" src="assets/img/avatar/avatar-5.png" class="rounded-circle">
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Alfa Zulkarnain</b>
                                        <p>Exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>

                    <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
                            class="nav-link notification-toggle nav-link-lg beep"><i class="far fa-bell"></i></a>
                        <div class="dropdown-menu dropdown-list dropdown-menu-right">
                            <div class="dropdown-header">Notifications
                                <div class="float-right">
                                    <a href="#">Mark All As Read</a>
                                </div>
                            </div>
                            <div class="dropdown-list-content dropdown-list-icons">
                                <a href="#" class="dropdown-item dropdown-item-unread">
                                    <div class="dropdown-item-icon bg-primary text-white">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Template update is available now!
                                        <div class="time text-primary">2 Min Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="far fa-user"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>You</b> and <b>Dedik Sugiharto</b> are now friends
                                        <div class="time">10 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-success text-white">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        <b>Kusnaedi</b> has moved task <b>Fix bug header</b> to <b>Done</b>
                                        <div class="time">12 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-danger text-white">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Low disk space. Let's clean it!
                                        <div class="time">17 Hours Ago</div>
                                    </div>
                                </a>
                                <a href="#" class="dropdown-item">
                                    <div class="dropdown-item-icon bg-info text-white">
                                        <i class="fas fa-bell"></i>
                                    </div>
                                    <div class="dropdown-item-desc">
                                        Welcome to Stisla template!
                                        <div class="time">Yesterday</div>
                                    </div>
                                </a>
                            </div>
                            <div class="dropdown-footer text-center">
                                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </li>

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
                        <li class="{{ Route::is('kategori.index', 'kategori.create', 'kategori.edit', 'produk.index', 'produk.create') ? 'active' : '' }} dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                                <i class="fas fa-columns"></i>
                                <span>Data Produk</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="{{ Route::is('kategori.index', 'kategori.create', 'kategori.edit') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('kategori.index') }}">Kategori Produk</a>
                                </li>
                                <li class="{{ Route::is('produk.index', 'produk.create') ? 'active' : '' }}">
                                    <a class="nav-link" href="{{ route('produk.index') }}">Master Produk</a>
                                </li>
                            </ul>
                        </li>

                        <li class="">
                            <a class="nav-link" href="credits.html">
                                <i class="fas fa-user-tag"></i>
                                <span>Data Pelanggan</span>
                            </a>
                        </li>

                        <li class="menu-header">Transaksi</li>

                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="fas fa-th-large"></i>
                                <span>Pesanan Pelanggan</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="nav-link beep beep-sidebar" href="components-avatar.html">Terbaru</a>
                                </li>
                                <li>
                                    <a class="nav-link beep beep-sidebar" href="components-avatar.html">Dalam Proses</a>
                                </li>
                                <li>
                                    <a class="nav-link beep beep-sidebar" href="components-avatar.html">Pesanan Selesai</a>
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
                        <li class="dropdown">
                            <a href="#" class="nav-link has-dropdown">
                                <i class="far fa-user"></i>
                                <span>Account User</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="auth-forgot-password.html">Role Users</a>
                                </li>
                                <li>
                                    <a href="auth-login.html">Data Users</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </aside>
            </div>

            <!-- Main Content -->
            @yield('body')

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad
                        Nauval Azhar</a>
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
    <script src="{{asset('assets/modules/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/stisla.js')}}"></script>

    <!-- JS Libraies -->
    <script src="{{asset('assets/modules/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('assets/modules/chart.min.js')}}"></script>
    <script src="{{asset('assets/modules/owlcarousel2/dist/owl.carousel.min.js')}}"></script>
    <script src="{{asset('assets/modules/summernote/summernote-bs4.js')}}"></script>
    <script src="{{asset('assets/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="{{asset('assets/js/page/index.js')}}"></script>

    <!-- Template JS File -->
    <script src="{{asset('assets/js/scripts.js')}}"></script>
    <script src="{{asset('assets/js/custom.js')}}"></script>
    <script src="{{asset('assets/js/page/modules-datatables.js')}}"></script>

    @include('sweetalert::alert')
    @yield('scripts')
    <script>
        $(document).ready(function(){
            $(".preloader").fadeOut();
        })
        $(document).ready(function() {
            $('.select').select2();
        });
    </script>
</body>

</html>
