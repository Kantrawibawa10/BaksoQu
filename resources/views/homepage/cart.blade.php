@extends('layouts.homepage')
@section('home')
<style>
    ::-webkit-scrollbar {
        width: 8px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

    body {
        font-family: 'Manrope', sans-serif;
        background: #eee;
    }

    .size span {
        font-size: 11px;
    }

    .color span {
        font-size: 11px;
    }

    .product-deta {
        margin-right: 70px;
    }

    .gift-card:focus {
        box-shadow: none;
    }

    .pay-button {
        color: #fff;
    }

    .pay-button:hover {
        color: #fff;
    }

    .pay-button:focus {
        color: #fff;
        box-shadow: none;
    }

    .text-grey {
        color: #a39f9f;
    }

    .qty i {
        font-size: 11px;
    }
</style>
<div class="container mt-3 mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="p-2">
                <h4>Produk cart <i class="bi bi-cart"></i></h4>
                <div class="d-flex flex-row align-items-center pull-right">
                    <span class="mr-1">Pesanan anda :</span>
                </div>
            </div>

            @if(isset($cart) && $cart->count() > 0)
                @foreach ($cart as $data)
                <div class="d-flex flex-row flex-wrap justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded">
                    <div class="mr-1 mb-3 mt-3"><img class="rounded" src="{{ asset('drive/produk/'. $data->photo) }}" width="100"></div>
                    <div class="d-flex flex-column align-items-center product-details mb-3 mt-3">
                        <span class="font-weight-bold text-capitalize">{{ $data->nama_produk }}</span>
                        <div class="size">
                            <span class="text-grey">Kategori:</span><span class="font-weight-bold">&nbsp; {{ $data->kategori_produk }}</span>
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center qty mb-3 mt-3">
                        <form id="form_minus_{{ $data->id }}" action="{{ route('stock.post', $data->id) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-sm px-1 pt-0 pb-0 btn-outline-dark" onclick="updateQuantity('{{ $data->id }}', 'min')">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="value" value="min">
                                <i class="bi bi-dash-lg text-danger" style="font-size: 18px;"></i>
                            </button>
                        </form>&nbsp;&nbsp;

                        <h5 class="text-grey mt-1 mr-1 ml-1" id="qty_{{ $data->id }}">{{ $data->qty }}</h5>&nbsp;&nbsp;

                        <form id="form_plus_{{ $data->id }}" action="{{ route('stock.post', $data->id) }}" method="POST">
                            @csrf
                            <button type="button" class="btn btn-sm px-1 pt-0 pb-0 btn-outline-dark" onclick="updateQuantity('{{ $data->id }}', 'plus')">
                                <input type="hidden" name="id" value="{{ $data->id }}">
                                <input type="hidden" name="value" value="plus">
                                <i class="bi bi-plus-lg text-success" style="font-size: 18px;"></i>
                            </button>
                        </form>
                    </div>
                    <div class="mb-0">
                        <h5 class="text-grey">Rp. {{ number_format($data->harga) }}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <form id="delKeranjang" action="{{ route('cart.destroy', $data->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="p-0 delete-button" style="outline: none; border: none; background: transparent; cursor: pointer;"><i class="bi bi-trash3-fill mb-1 text-danger" style="font-size: 20px;"></i></button>
                        </form>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-lg-12 col-md-12">
                    <div class="card border-0">
                        <div class="card-body d-flex justify-content-center">
                            <div>
                                <img src="{{ URL::to('assets/img/loader/cart.gif') }}" width="200">
                                <p class="text-center">Keranjang anda kosong</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex flex-row justify-content-between align-items-center mt-3 p-3 bg-white rounded">
                <span class="text-secondary text-start">Total Transaksi:</span>
                <span class="text-secondary text-end">Rp. {{ number_format($cart->sum('harga')) }}</span>
            </div>

            @if(isset($cart) && $cart->count() > 0)
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded">
                    <button class="btn btn-warning btn-block btn-lg ml-2 pay-button" type="button">Proceed to Pay</button>
                </div>
            @endif
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    function updateQuantity(id, action) {
        var formData = {
            id: id,
            value: action,
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            type: 'POST',
            url: '{{ route('stock.post', ':id') }}'.replace(':id', id),
            data: formData,
            success: function (data) {
                // Update the quantity display on success
                $('#qty_' + id).text(data.qty);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const delKeranjang = document.getElementById('delKeranjang');
                const deleteUrl = delKeranjang.getAttribute('action');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Data Anda akan dihapus. Tekan tombol Ya, Hapus untuk melanjutkan',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Hapus formulir jika SweetAlert dikonfirmasi
                        delKeranjang.style.display = 'none';

                        // Lakukan penghapusan dengan mengirimkan formulir
                        delKeranjang.submit();
                    }
                });
            });
        });
</script>
@endsection
