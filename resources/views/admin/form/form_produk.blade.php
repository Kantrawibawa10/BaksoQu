@extends('layouts.admin')
@section('body')
@php
    $photo = asset('drive/produk/' . ($edit->photo ?? 'upload.gif'));
@endphp
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Master Produk</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('produk.index') }}" style="outline: none; text-decoration: none;"><i
                                class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="card-body shadow rounded mb-5">
                            <h6 style="font-weight: 400;"><b>Required!!</b></h6>
                            <p style="font-style: italic;" class="mb-0">Inputan Yang Ditanda Bintang Merah (*) Harus Di
                                Isi !!</p>
                            <p style="font-style: italic;" class="mb-0 text-capitalize">Inputan nilai mata uang cukup
                                diinput nilai angka (contoh: 100000) untuk Rp. 100.000 !!</p>
                            <p style="font-style: italic;" class="mb-0 text-capitalize">Inputan nilai PPN cukup diinput
                                nilai angka (contoh: 11) untuk 11% !!</p>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-12">
                                <p style="color: black; font-size: 20px; font-weight: 500;">Master Produk</p>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row">
                                        {{-- Foto produk --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Gambar Produk
                                                    :</label>
                                            </div>
                                            <div class="col-lg-5 mb-2">
                                                <div class="upload-container">
                                                    <div class="thumbnail-container">
                                                        <img src="{{ $photo }}"
                                                            alt="Profile Image" id="previewImage">
                                                        <div class="overlay">
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
                                        {{-- Foto produk --}}

                                        {{-- Nama produk --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Nama Produk :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="hidden" name="id" value="{{ $edit->id ?? '' }}">
                                                <input type="hidden" name="aksi" value="{{ $title }}">

                                                <input type="text"
                                                    class="form-control text-capitalize @error ('nama_produk') is-invalid @enderror"
                                                    name="nama_produk"
                                                    value="{{ $edit->nama_produk ?? old('nama_produk') }}"
                                                    placeholder="Nama Produk">
                                                @error('nama_produk')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Nama produk --}}

                                        {{-- Kategori produk --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Kategori Produk
                                                    :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <select name="kategori_produk"
                                                    class="form-control select @error ('kategori_produk') is-invalid @enderror">
                                                    @php
                                                    $selectKategori = $edit->kategori_produk ?? old('kategori_produk');
                                                    @endphp
                                                    <option selected disabled>Pilih kategori produk..</option>
                                                    @foreach ($kategori as $item)
                                                    <option value="{{ $item->kategori_produk }}" {{
                                                        $selectKategori==$item->kategori_produk ? 'selected' : '' }}>{{
                                                        $item->kategori_produk }}</option>
                                                    @endforeach
                                                </select>
                                                @error('kategori_produk')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Kategori produk --}}

                                        {{-- Harga produk --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Harga Produk :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number"
                                                    class="form-control text-capitalize @error ('harga_produk') is-invalid @enderror"
                                                    min="0" name="harga_produk"
                                                    value="{{ $edit->harga_produk ?? old('harga_produk') }}"
                                                    placeholder="Rp.">
                                                @error('harga_produk')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Harga produk --}}

                                        {{-- PPN --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">PPN :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number"
                                                    class="form-control text-capitalize @error ('ppn') is-invalid @enderror"
                                                    min="0" name="ppn" value="{{ $edit->ppn ?? old('ppn') }}"
                                                    placeholder="%">
                                                @error('ppn')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- PPN --}}

                                        {{-- Stock Awal --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Stock Saat Ini
                                                    :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number"
                                                    class="form-control text-capitalize @error ('stock') is-invalid @enderror"
                                                    min="0" name="stock" value="{{ $edit->stock ?? old('stock') }}"
                                                    placeholder="0">
                                                @error('stock')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Stock Awal --}}

                                        {{-- Deskripsi produk --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Deskripsi Produk :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <textarea type="text" id="editor"
                                                    class=" @error ('deskripsi') is-invalid @enderror" name="deskripsi"
                                                    placeholder="0">{{ $edit->deskripsi ?? old('deskripsi') }}</textarea>
                                                @error('deskripsi')
                                                <small class="form-text text-danger">
                                                    {{ $message }}
                                                </small>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- Deskripsi produk --}}
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
