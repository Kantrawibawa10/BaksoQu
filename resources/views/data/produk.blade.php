@if(isset($produk) && $produk->count() > 0)
@foreach ($produk as $data)
@php
    $ppn = $data->harga_produk * $data->ppn/100;
    $total = $data->harga_produk + $ppn;
@endphp
<div class="col-xxl-3 col-lg-3 col-md-6 col-6 mb-3">
    <div class="card shadow">
        <a href="{{ route('produk-kami.show', $data->id) }}" style="text-decoration: none; color: black;">
            <img src="{{ asset('drive/produk/'. $data->photo) }}" class="card-img-top"
                alt="{{ $data->nama_produk ?? 'tidak ada' }}"
                style="background-size: cover; background-position: center; height: 140px; max-width: 100%; object-fit: content;">
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
                <div class="col-12 d-flex justify-content-between mb-3 mt-3">
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
                <p>Tidak ada produk ditemukan</p>
            </div>
        </div>
    </div>
</div>
@endif
