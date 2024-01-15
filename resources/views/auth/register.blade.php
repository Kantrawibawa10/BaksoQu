<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; BaksoQu</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('assets/img/logo/icon-logo.png') }}" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="assets/modules/jquery-selectric/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
    </script>

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
            transform: translate(-50%, -50%);
            font: 14px arial;
        }
    </style>
    <!-- /END GA -->
</head>

<body>
    <div class="preloader">
        <div class="loading">
            <img src="{{URL::to('assets/img/loader/loading.gif')}}" width="300">
        </div>
    </div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="{{ asset('assets/img/logo/icon-logo.png') }}" alt="logo" width="100"
                                class="shadow-light rounded-circle"> BaksoQu
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('register.store') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-12">
                                            <label for="fullName">Nama Lengkap</label>
                                            <input type="text" class="form-control @error ('nama') is-invalid @enderror" id="fullName" name="nama"
                                                placeholder="Nama Lengkap" value="{{ old('nama') }}">
                                            @error('nama')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="eMail">Email</label>
                                            <input type="email" class="form-control @error ('email') is-invalid @enderror" id="eMail" name="email"
                                                placeholder="Email anda" value="{{ old('email') }}">
                                            @error('email')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="phone">Telepon/Whatsapp</label>
                                            <input type="text" class="form-control @error ('no_telepon') is-invalid @enderror" id="phone" name="no_telepon"
                                                placeholder="08xxxxx" value="{{ old('no_telepon') }}">
                                            @error('no_telepon')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="username">Username</label>
                                            <input type="username" class="form-control @error ('username') is-invalid @enderror" id="username" name="username"
                                                placeholder="Username anda" value="{{ old('username') }}">
                                            @error('username')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" name="password"
                                                placeholder="Password anda" value="{{ old('password') }}">
                                            @error('password')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                    </div>





                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Sudah punya akun? <a href="{{ route('login') }}">Login aja</a>
                        </div>

                        <div class="simple-footer">
                            Copyright &copy; 2023 BaksoQu
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="assets/modules/jquery.min.js"></script>
    <script src="assets/modules/popper.js"></script>
    <script src="assets/modules/tooltip.js"></script>
    <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="assets/modules/moment.min.js"></script>
    <script src="assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="assets/js/page/auth-register.js"></script>

    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
        $(document).ready(function(){
          $(".preloader").fadeOut();
        })
    </script>
</body>

</html>
