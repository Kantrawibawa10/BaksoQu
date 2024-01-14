@if(isset($cart) && $cart->count() > 0)
@foreach ($cart as $data)
<div class="d-flex flex-row flex-wrap justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded shadow">
    <div class="mr-1 mb-3 mt-3 col-lg-1 col-md-2 col-6">
        <img class="rounded" src="{{ asset('drive/produk/'. $data->photo) }}"
            style="width: 100%; height: 60px; object-fit: cover;">
    </div>

    <div class="d-flex flex-column align-items-center product-details mb-3 mt-3 col-lg-4 col-md-4 col-12">
        <span class="font-weight-bold text-center text-capitalize">{{ $data->nama_produk }}</span>
        <div class="size text-center">
            <span class="text-grey">Kategori:</span><span class="font-weight-bold">&nbsp; {{ $data->kategori_produk
                }}</span>
        </div>
    </div>

    <div class="d-flex flex-row align-items-center qty mb-3 mt-3 col-lg-3 col-md-4 col-12">
        <form id="form_minus_{{ $data->id }}" action="{{ route('stock.post', $data->id) }}" method="POST">
            @csrf
            <button type="button" class="btn btn-sm px-1 pt-0 pb-0 btn-outline-dark"
                onclick="updateQuantity('{{ $data->id }}', 'min')">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" name="value" value="min">
                <i class="bi bi-dash-lg text-danger" style="font-size: 18px;"></i>
            </button>
        </form>&nbsp;&nbsp;

        <h5 class="text-grey mt-1 mr-1 ml-1" id="qty_{{ $data->id }}">{{ $data->qty }}</h5>&nbsp;&nbsp;

        <form id="form_plus_{{ $data->id }}" action="{{ route('stock.post', $data->id) }}" method="POST">
            @csrf
            <button type="button" class="btn btn-sm px-1 pt-0 pb-0 btn-outline-dark"
                onclick="updateQuantity('{{ $data->id }}', 'plus')">
                <input type="hidden" name="id" value="{{ $data->id }}">
                <input type="hidden" name="value" value="plus">
                <i class="bi bi-plus-lg text-success" style="font-size: 18px;"></i>
            </button>
        </form>
    </div>

    <div class="mb-2 col-lg-3 col-md-2 col-12">
        <h6 class="text-dark m-auto">Rp. {{ number_format($data->harga_produk) }}<span
                style="color: gray; font-size: 12px;">/pcs</span></h6>
    </div>

    <div class="d-flex align-items-center mb-2 col-lg-1 col-md-2 col-12">
        <form id="delKeranjang" action="{{ route('cart.destroy', $data->id) }}" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
            <button type="button" class="p-0 delete-button"
                style="outline: none; border: none; background: transparent; cursor: pointer;"><i
                    class="bi bi-trash3-fill mb-1 text-danger" style="font-size: 20px;"></i></button>
        </form>
    </div>
</div>
@endforeach
@else
<div class="col-lg-12 col-md-12">
    <div class="card border-0 shadow">
        <div class="card-body d-flex justify-content-center">
            <div>
                <img src="{{ URL::to('assets/img/loader/cart.gif') }}" width="200">
                <p class="text-center">Keranjang anda kosong</p>
            </div>
        </div>
    </div>
</div>
@endif
