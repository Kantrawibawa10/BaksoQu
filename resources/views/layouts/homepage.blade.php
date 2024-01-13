<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/icon-logo.png') }}" />
    <title>BaksoQu</title>
    <style>
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

        .icon-keranjang {
            font-size: 24px;
            color: rgb(255, 153, 0);
            position: relative;
        }

        .notif-keranjang {
            font-size: 10px;
            background-color:rgb(255, 153, 0);
            color: #fff;
            border-radius: 50%;
            padding: 2px 6px;
            position: absolute;
        }

        .notif-riwayat {
            font-size: 10px;
            background-color:rgb(1, 43, 106);
            color: #fff;
            border-radius: 50%;
            padding: 3px 6px;
        }

        .custom-search {
            position: relative;
        }

        .custom-search input {
            padding-right: 30px;
            border-radius: 24px;
            font-size: 15px;
        }

        .custom-search .input-group-text {
            background: none;
            border: none;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            padding: 10px;
            cursor: pointer;
            transition: color 0.3s ease; /* Tambahkan transisi warna untuk efek yang halus */
        }

        .custom-search input:focus + .input-group-text,
        .custom-search input:not(:placeholder-shown) + .input-group-text {
            color: #000; /* Ganti dengan warna yang diinginkan saat input aktif atau terisi */
        }
    </style>
</head>
<body>
    <div class="preloader">
        <div class="loading">
          <img src="{{URL::to('assets/img/loader/loading.gif')}}" width="300">
        </div>
    </div>

    @include('layouts.navbar')

    <div class="container">
        @yield('home')
    </div>

    <footer class="container py-5 pt-5 border-top">
        <div class="container row">
            <div class="col-lg-12 col-12 col-md">
                <p class="h2" style="color: rgb(255, 167, 26);">
                    <img src="{{ asset('assets/img/logo/icon-logo.png') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle"> BaksoQu
                </p>
                <small class="d-block mb-3 text-muted">&copy; 2022–2024</small>
            </div>
            <div class="col-lg-4 col-12">
                <h5>Menu</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Beranda</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Produk Kami</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Blog</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#">Kontak Kami</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-12">
                <h5>Jadwal Buka</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Senin 09.00 - 22.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Selasa 09.00 - 22.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Rabu 09.00 - 22.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Kamis 09.00 - 22.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Jumat 09.00 - 22.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Sabtu 09.00 - 22.00 WITA</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i class="bi bi-clock"></i>
                            Minggu 09.00 - 00.00 WITA</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-12">
                <h5>Social Media</h5>
                <ul class="list-unstyled text-small">
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-instagram"></i> Instagram</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-facebook"></i> Facebook</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-whatsapp"></i> WhatsAap</a></li>
                    <li class="mb-1"><a class="link-secondary text-decoration-none" href="#"><i
                                class="bi bi-tiktok"></i> TikTok</a></li>
                </ul>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js">
    </script>
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function(){
          $(".preloader").fadeOut();
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        CKEDITOR.replace('editor', {
            toolbar: [
                ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'],
                ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'],
                ['Undo', 'Redo', '-', 'RemoveFormat']
            ],
            removePlugins: 'image, imagecaption, imagestyle, imagetoolbar, imageupload, mediaembed, link, linkimage, linkpaste'
        });
    </script>
    @include('sweetalert::alert')
</body>
</html>
