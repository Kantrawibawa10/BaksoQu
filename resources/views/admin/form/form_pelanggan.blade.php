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
                <div class="breadcrumb-item active"><a href="#">Detail Pelanggan</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('pelanggan.index') }}" style="outline: none; text-decoration: none;"><i
                                class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="card-body shadow rounded mb-5">
                            <p style="font-style: italic;" class="mb-0">Berisi info data diri pelanggan !!</p>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-12">
                                <p style="color: black; font-size: 20px; font-weight: 500;">Detail Pelanggan</p>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row">
                                        {{-- Foto pelanggan --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Profile
                                                    :</label>
                                            </div>
                                            <div class="col-lg-5 mb-2">
                                                <img src="{{ $photo }}" alt="Profile Image" width="150" height="150" class="rounded-pill border" style="border-radius: 50%;">
                                            </div>
                                        </div>
                                        {{-- Foto pelanggan --}}

                                        {{-- Nama pelanggan --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Nama Pelanggan :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="text" class="form-control text-capitalize bg-transparent" value="{{ $edit->nama ?? 'data kosong' }}" readonly>
                                            </div>
                                        </div>
                                        {{-- Nama pelanggan --}}


                                        {{-- Telepon pelanggan --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Telepon Pelanggan :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="number"
                                                    class="form-control" value="{{ $edit->no_telepon ?? 'data kosong' }}">
                                            </div>
                                        </div>
                                        {{-- Telepon pelanggan --}}

                                        {{-- Emai; pelanggan --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Email Pelanggan :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <input type="text"
                                                    class="form-control" value="{{ $edit->email ?? 'data kosong' }}">
                                            </div>
                                        </div>
                                        {{-- Email pelanggan --}}

                                        {{-- Deskripsi pelanggan --}}
                                        <div class="row col-lg-12 mb-3">
                                            <div class="col-lg-4 mt-3">
                                                <label style="font-size: 15px; font-weight: 500;">Alamat pelanggan :</label>
                                            </div>
                                            <div class="col-lg-5">
                                                <textarea type="text"
                                                    class="form-control bg-transparent"
                                                    placeholder="0">{{ $edit->alamat ?? old('alamat') }}</textarea>
                                            </div>
                                        </div>
                                        {{-- Deskripsi pelanggan --}}
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

@endsection
