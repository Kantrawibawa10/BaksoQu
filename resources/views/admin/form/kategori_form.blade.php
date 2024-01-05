@extends('layouts.admin')
@section('body')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>{{ $title }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Kategori</a></div>
                <div class="breadcrumb-item">{{ $title }}</div>
            </div>
        </div>

        <form action="" method="">
            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('kategori.index') }}" style="outline: none; text-decoration: none;"><i class="fas fa-arrow-left"></i> Kembali</a>
                    </div>
                    <div class="card-body">
                        <div class="card-body shadow rounded mb-5">
                            <h6 style="font-weight: 400;"><b>Required!!</b></h6>
                            <p style="font-style: italic;" class="mb-0">Inputan Yang Ditanda Bintang Merah (*) Harus Di Isi !!</p>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-12">
                                <p style="color: black; font-size: 20px; font-weight: 500;">Kategori Produk</p>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-4 m-auto">
                                            <label style="font-size: 15px; font-weight: 700;">Nama Kategori :</label>
                                        </div>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" name="kategori">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="offset-md-4">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="btn btn-primary mr-1"><i class="fas fa-check-double mr-1"></i> Simpan</button>
                                        <button type="reset" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i> Reset</button>
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
