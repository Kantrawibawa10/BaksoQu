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
<style>
    .image-preview {
        text-align: center;
        margin-top: 10px;
    }

    #previewImage {
        max-width: 100%;
        max-height: 200px;
    }

    #previewImage1 {
        max-width: 100%;
        max-height: 200px;
    }

    .upload-container {
        position: relative;
    }

    .profile-image-container {
        position: relative;
        width: 150px;
        height: 150px;
        overflow: hidden;
        border-radius: 50%;
        border: 1px solid black;
    }

    .profile-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
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
</style>

@php
    $iconProfile = asset('drive/users/' . (auth()->user()->photo ?? 'upload.gif'));
@endphp

<form action="{{ route('myprofile.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="id" value="{{ auth()->user()->id ?? '' }}">
    <input type="hidden" name="aksi" value="Update profile">
    <div class="container mt-4 mb-5">
        <div class="container row justify-content-center align-items-center">
            <div class="container">
                <div class="row gutters">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="account-settings">
                                    <div class="user-profile">
                                        <div class="upload-container d-flex justify-content-center mb-2">
                                            <div class="profile-image-container">
                                                <img src="{{ $iconProfile }}" alt="Profile Image" id="previewImage">
                                                <div class="overlay">
                                                    <label for="upload-input" class="upload-button">
                                                        <i class="bi bi-camera mr-1"></i> Upload
                                                    </label>
                                                    <input type="file" id="upload-input" name="profile" accept="image/*">
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="user-name">{{ auth()->user()->nama }}</h5>
                                        <h6 class="user-email">
                                            {{ auth()->user()->email }}
                                        </h6>
                                    </div>
                                    <div class="row justify-content-center col-12">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="username" class="form-control @error ('username') is-invalid @enderror" id="username" name="username"
                                                    placeholder="Username anda" value="{{ auth()->user()->username }}">
                                                @error('username')
                                                    <small class="form-text text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" name="password"
                                                    placeholder="Password anda">
                                                @error('password')
                                                    <small class="form-text text-danger">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                                <p class="form-text mb-0" style="font-size: 12px; color: rgb(2, 59, 124);;">! Kosongkan input jika tidak melakukan perubahan password</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <h6 class="mb-2 text-primary">Profile Anda</h6>
                                    </div>

                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="fullName">Nama Lengkap</label>
                                            <input type="text" class="form-control @error ('nama') is-invalid @enderror" id="fullName" name="nama"
                                                placeholder="Nama Lengkap" value="{{ auth()->user()->nama }}">
                                            @error('nama')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="eMail">Email</label>
                                            <input type="email" class="form-control @error ('email') is-invalid @enderror" id="eMail" name="email"
                                                placeholder="Email anda" value="{{ auth()->user()->email }}">
                                            @error('email')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                                        <div class="form-group">
                                            <label for="phone">Telepon/Whatsapp</label>
                                            <input type="text" class="form-control @error ('no_telepon') is-invalid @enderror" id="phone" name="no_telepon"
                                                placeholder="" value="{{ auth()->user()->no_telepon }}">
                                            @error('no_telepon')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                            @enderror
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
                                            @if(auth()->user()->alamat == null)
                                                <p class="form-text mb-0" style="font-size: 12px; color: rgb(255, 0, 17);;">! Lengkapi data gender terlebih dahulu</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row gutters">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                                        <div class="text-right">
                                            <button type="button" id="submit" name="submit"
                                                class="btn btn-secondary">Cancel</button>
                                            <button type="submit" id="submit" name="submit"
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
</form>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Kode JavaScript Anda disini
        var fileInput = document.getElementById("upload-input");
        var imagePreview = document.getElementById("previewImage");

        fileInput.addEventListener("change", function() {
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                imagePreview.src = "{{ $iconProfile }}";
            }
        });
    });

</script>
@endsection
