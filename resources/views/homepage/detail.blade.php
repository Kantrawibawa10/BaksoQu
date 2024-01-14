@extends('layouts.homepage')
@section('home')
@php
    $ppn = $detail->harga_produk * $detail->ppn/100;
    $detail_total = $detail->harga_produk + $ppn;
@endphp
<div class="container mt-3 mb-5">
    <div class="container row justify-content-center align-items-center">
        <div class="container px-4 px-lg-5 my-5">
            <a href="{{ route('home') }}" class="text-warning" style="text-decoration: none; font-size: 18px;">
                <i class="bi bi-arrow-left"></i> Kembali ke produk
            </a>

            <div class="mt-3 row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('drive/produk/'. $detail->photo) }}" width="500" height="600" style="object-fit: cover;" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1"><i class="bi bi-egg-fried"></i> {{ $detail->kategori_produk ?? 'tidak ada' }}</div>
                    <h1 class="display-5 fw-bolder text-capitalize">{{ $detail->nama_produk ?? 'tidak ada' }}</h1>
                    <div class="fs-5 mb-5">
                        <h4>Rp. {{ number_format($detail_total) }}</h4>
                    </div>
                    <p class="lead">{!! $detail->deskripsi !!}</p>
                    <div class="">
                        <button class="btn btn-outline-dark flex-shrink-0" type="button" data-bs-toggle="modal" data-bs-target="#keranjang{{ $detail->id }}">
                            <i class="bi-cart-fill me-1"></i>
                            Masukan keranjang
                        </button>
                        <button class="btn btn-warning flex-shrink-0" type="button" data-bs-toggle="modal" data-bs-target="#beli{{ $detail->id }}">
                            Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5">
        <div class="container px-4 px-lg-5 mt-4">
            <h2 class="fw-bolder mb-4">Produk Lainnya</h2>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
                @if(isset($produk) && $produk->count() > 0)
                    @foreach ($produk as $data)
                    @php
                        $ppn = $data->harga_produk * $data->ppn/100;
                        $total = $data->harga_produk + $ppn;
                    @endphp
                    <div class="col-xxl-3 col-lg-3 col-md-6 mb-3">
                        <div class="card shadow">
                            <a href="{{ route('produk-kami.show', $data->id) }}" style="text-decoration: none; color: black;">
                                <img src="{{ asset('drive/produk/'. $data->photo) }}" class="card-img-top"
                                    alt="{{ $data->nama_produk ?? 'tidak ada' }}"
                                    style="background-size: cover; background-position: center; height: 150px; max-width: 100%; object-fit: cover;">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <small class="card-text mb-1 text-secondary"><i class="bi bi-egg-fried"></i> {{
                                                $data->kategori_produk ?? 'tidak ada' }}</small>
                                            <h6 class="card-title text-capitalize">{{ $data->nama_produk ?? 'tidak ada'}}</h6>
                                        </div>
                                        <div class="col-12">
                                            <small class="float-right">Tersedia : {{ $data->stock ?? 'tidak ada' }}</small><br>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between mb-2 mt-3">
                                        <h6 class="text-start"><b>Rp. {{ number_format($total ?? 'Rp. 0') }}</b></h6>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach
                @else
                <div class="col-lg-12 col-md-12">
                    <div class="card border-0">
                        <div class="card-body d-flex justify-content-center">
                            <div>
                                <img src="{{ URL::to('assets/img/loader/loading.gif') }}" width="200">
                                <p>Tidak ada produk yang serupa</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="keranjang{{ $detail->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-body">
            <form action="{{ route('posts.cart') }}" method="POST">
                @csrf
                <div class="d-flex justify-content-between">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <img class="card-img-top mb-5 mb-md-0" src="{{ asset('drive/produk/'. $detail->photo) }}" width="100" height="100" style="object-fit: cover;" alt="..." />
                        </div>
                        <div class="col-md-7">
                            <div>
                                <br>
                                <br>
                            </div>
                            <h6 class="mb-0">{{ $detail->nama_produk }}</h6>
                            <h6 class="mb-0">Rp. {{ number_format($detail_total) }}</h6>
                            <label class="text-secondary" style="font-size: 14px;">Stok : {{ $detail->stock }}</label>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="d-flex justify-content-between mt-3 align-items-center mb-3">
                    <span>Jumlah</span>
                    <input class="form-control form-control-sm text-center" id="inputQuantity" type="number" min="1" value="1" style="max-width: 5rem" name="qty" />
                    <input type="hidden" name="kode_produk" value="{{ $detail->kode_produk }}">
                </div>
                <button type="submit" class="btn btn-warning col-12">Masukan Keranjang</button>
            </form>
        </div>
      </div>
    </div>
</div>

<div class="modal fade" id="beli{{ $detail->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
      <div class="modal-content">
        <div class="modal-body">
            <div class="d-flex justify-content-between">
                <div class="row g-3">
                    <div class="col-md-5">
                        <img class="card-img-top mb-5 mb-md-0" src="{{ asset('drive/produk/'. $detail->photo) }}" width="100" height="100" style="object-fit: cover;" alt="..." />
                    </div>
                    <div class="col-md-7">
                        <div>
                            <br>
                            <br>
                        </div>
                        <h6 class="mb-0">Rp. {{ number_format($detail_total) }}</h6>
                        <label class="text-secondary" style="font-size: 14px;">Stok {{ $detail->stock }}</label>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="d-flex justify-content-between mt-3 align-items-center mb-3">
                <span>Jumlah</span>
                <input class="form-control form-control-sm text-center" id="inputQuantity" type="number" min="1" value="1" style="max-width: 5rem" />
            </div>
            <button type="button" class="btn btn-success col-12">Beli Sekarang</button>
        </div>
      </div>
    </div>
</div>
@endsection
