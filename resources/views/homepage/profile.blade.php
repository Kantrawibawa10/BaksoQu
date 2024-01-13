@extends('layouts.homepage')
@section('home')
<style type="text/css">
    .account-settings .user-profile {
        margin: 0 0 1rem 0;
        padding-bottom: 1rem;
        text-align: center;
    }

    .account-settings .user-profile .user-avatar {
        margin: 0 0 1rem 0;
    }

    .account-settings .user-profile .user-avatar img {
        width: 90px;
        height: 90px;
        -webkit-border-radius: 100px;
        -moz-border-radius: 100px;
        border-radius: 100px;
    }

    .account-settings .user-profile h5.user-name {
        margin: 0 0 0.5rem 0;
    }

    .account-settings .user-profile h6.user-email {
        margin: 0;
        font-size: 0.8rem;
        font-weight: 400;
        color: #9fa8b9;
    }

    .account-settings .about {
        margin: 2rem 0 0 0;
        text-align: center;
    }

    .account-settings .about h5 {
        margin: 0 0 15px 0;
        color: #007ae1;
    }

    .account-settings .about p {
        font-size: 0.825rem;
    }

    .form-control {
        border: 1px solid #cfd1d8;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        font-size: .825rem;
        background: #ffffff;
        color: #2e323c;
    }

    .card {
        background: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        border: 0;
        margin-bottom: 1rem;
    }
</style>

<div class="container mt-4 mb-5">
    <div class="container row justify-content-center align-items-center">
        <div class="container">
            <div class="row gutters">
                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="account-settings">
                                <div class="user-profile">
                                    <div class="user-avatar">
                                        <img src="{{ asset('drive/users/' . (auth()->user()->photo ?? 'upload.gif')) }}"
                                            alt="{{ auth()->user()->admin }}" style="">
                                    </div>
                                    <h5 class="user-name">{{ auth()->user()->nama }}</h5>
                                    <h6 class="user-email">
                                        {{ auth()->user()->email }}
                                    </h6>
                                </div>
                                <div class="about">
                                    <h5>About</h5>
                                    <p>I'm Yuki. Full Stack Designer I enjoy creating user-centric, delightful and human
                                        experiences.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <h6 class="mb-2 text-primary">Profile Anda</h6>
                                </div>

                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="fullName">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="fullName" name="nama"
                                            placeholder="Nama Lengkap" value="{{ auth()->user()->nama }}">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="eMail">Email</label>
                                        <input type="email" class="form-control" id="eMail" name="email"
                                            placeholder="Email anda" value="{{ auth()->user()->email }}">
                                    </div>
                                </div>

                                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="phone">Telepon/Whatsapp</label>
                                        <input type="text" class="form-control" id="phone" name="no_telepon"
                                            placeholder="" value="{{ auth()->user()->no_telepon }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                    <h6 class="mt-3 mb-2 text-primary">Alamat Anda</h6>
                                </div>
                                <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                    <div class="form-group">
                                        <label for="Street">Alamat</label>
                                        <textarea type="text" id="editor"
                                            class=" @error ('alamat') is-invalid @enderror" name="alamat"
                                            placeholder="0">{{ auth()->user()->alamat ?? old('alamat') }}</textarea>
                                        @error('alamat')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row gutters">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                    <div class="text-right">
                                        <button type="button" id="submit" name="submit"
                                            class="btn btn-secondary">Cancel</button>
                                        <button type="button" id="submit" name="submit"
                                            class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
