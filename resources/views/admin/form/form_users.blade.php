@extends('layouts.admin')
@section('body')
@php
    $photo = asset('drive/users/' . ($edit->photo ?? 'upload.gif'));
@endphp
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Data users</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('users.index') }}" style="outline: none; text-decoration: none;"><i
                                class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="card-body shadow rounded mb-5">
                            <h6 style="font-weight: 400;"><b>Required!!</b></h6>
                            <p style="font-style: italic;" class="mb-0">Inputan Yang Ditanda Bintang Merah (*) Harus Di
                                Isi !!</p>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-12">
                                <p style="color: black; font-size: 20px; font-weight: 500;">Detail Users</p>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row">
                                        {{-- Foto profile --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Profile
                                                    :</label>
                                            </div>
                                            <div class="col-lg-5 mb-2">
                                                <div class="upload-container" style="width: 150px; height: 150px; border: none;">
                                                    <div class="thumbnail-container" style="width: 150px; height: 150px; border: none;">
                                                        <img src="{{ $photo }}" alt="Profile Image" id="previewImage" class="rounded-pill border" style="border-radius: 50%; border: none;" width="150" height="150">
                                                        <div class="overlay" style="border-radius: 50%; border: none;">
                                                            <label for="upload-input" class="upload-button">
                                                                <i class="bi bi-camera mr-1"></i> Upload
                                                            </label>
                                                            <input type="file" id="upload-input" name="photo"
                                                                accept="image/*"
                                                                class="@error ('photo') is-invalid @enderror">
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('photo')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Foto profile --}}

                                        {{-- Nama users --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Nama<span class="text-danger">*</span> :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">
                                                <input type="hidden" name="aksi" value="{{ $title }}">

                                                <input type="text"
                                                    class="form-control text-capitalize @error ('nama') is-invalid @enderror"
                                                    name="nama"
                                                    value="{{ $edit->nama ?? old('nama') }}"
                                                    placeholder="Nama Users">
                                                @error('nama')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Nama users --}}

                                        {{-- Email users --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Email :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="email"
                                                    class="form-control"
                                                    name="email"
                                                    value="{{ $edit->email ?? old('email') }}"
                                                    placeholder="example@gmail.com">
                                            </div>
                                        </div>
                                        {{-- Email users --}}

                                        {{-- Telpon users --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Telepon/Whatsapp<span class="text-danger">*</span> :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number" min="0"
                                                    class="form-control text-capitalize @error ('no_telepon') is-invalid @enderror"
                                                    name="no_telepon"
                                                    value="{{ $edit->no_telepon ?? old('no_telepon') }}"
                                                    placeholder="0xxxxxxxx">
                                                @error('no_telepon')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Telpon users --}}

                                         {{-- Usersname --}}
                                         <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Username<span class="text-danger">*</span> :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="text"
                                                    class="form-control @error ('username') is-invalid @enderror"
                                                    name="username"
                                                    value="{{ $edit->username ?? old('username') }}"
                                                    placeholder="Username">
                                                @error('username')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Usersname --}}

                                         {{-- Password --}}
                                         <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Password<span class="text-danger">*</span> :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="password"
                                                    class="form-control @error ('password') is-invalid @enderror mb-0" name="password" placeholder="xxxxxxxxxx">
                                                <p class="text-primary mb-0" style="font-size: 12px;">*)Kosongkan input jika tidak perubahan</p>
                                                @error('password')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Password --}}

                                        {{-- Role users --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Role Users<span class="text-danger">*</span>
                                                    :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <select name="role"
                                                    class="form-control select @error ('role') is-invalid @enderror">
                                                    @php
                                                        $selectRole = $edit->role ?? old('role');
                                                    @endphp
                                                    <option selected disabled>Pilih role users..</option>
                                                    @foreach ($role as $item)
                                                    <option value="{{ $item->roles }}" {{
                                                        $selectRole==$item->roles ? 'selected' : '' }}>{{
                                                        $item->roles }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kategori_produk')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Role users --}}

                                        {{-- Alamat --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Alamat<span class="text-danger">*</span> :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <textarea type="text" id="editor"
                                                    class=" @error ('alamat') is-invalid @enderror" name="alamat"
                                                    placeholder="0">{{ $edit->alamat ?? old('alamat') }}</textarea>
                                                @error('alamat')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Alamat --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 ">
                                <div class="offset-md-4">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary mr-1"><i
                                                class="fas fa-check-double mr-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>
                                            Reset</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>

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
                imagePreview.src = "{{ $photo }}";
            }
        });
    });
</script>
@endsection
