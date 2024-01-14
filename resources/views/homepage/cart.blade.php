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
        background: #ffffff;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

    body {
        font-family: 'Manrope', sans-serif;
        background: #ffffff;
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
<div class="container mt-5 mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8">
            <div class="p-2">
                <h4>Produk cart <i class="bi bi-cart"></i></h4>
                <div class="d-flex flex-row align-items-center pull-right">
                    <span class="mr-1">Pesanan anda :</span>
                </div>
            </div>

            <div id="cartContainer">
                @if(isset($cart) && $cart->count() > 0)
                    @foreach ($cart as $data)
                    <div class="d-flex flex-row flex-wrap justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded shadow">
                        <div class="mr-1 mb-3 mt-3 col-lg-1 col-md-2 col-6">
                            <img class="rounded" src="{{ asset('drive/produk/'. $data->photo) }}" style="width: 100%; height: 60px; object-fit: cover;">
                        </div>

                        <div class="d-flex flex-column align-items-center product-details mb-3 mt-3 col-lg-4 col-md-4 col-12">
                            <span class="font-weight-bold text-center text-capitalize">{{ $data->nama_produk }}</span>
                            <div class="size text-center">
                                <span class="text-grey">Kategori:</span><span class="font-weight-bold">&nbsp; {{ $data->kategori_produk }}</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row align-items-center qty mb-3 mt-3 col-lg-3 col-md-4 col-12">
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

                        <div class="mb-2 col-lg-3 col-md-2 col-12">
                            <h6 class="text-dark m-auto">Rp. {{ number_format($data->harga_produk) }}<span style="color: gray; font-size: 12px;">/pcs</span></h6>
                        </div>

                        <div class="d-flex align-items-center mb-2 col-lg-1 col-md-2 col-12">
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
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center mt-3 p-3 bg-white rounded shadow">
                <span class="text-secondary text-start">Total Transaksi:</span>
                <span id="refreshText" class="text-secondary text-end">Rp. {{ number_format($cart->sum('harga')) }}</span>
            </div>

            @if(isset($cart) && $cart->count() > 0)
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded shadow">
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

        if (action === 'min') {
            if ($('#qty_' + id).text() > 1) {
                performUpdate();
                return;
            }

            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah Anda yakin akan menghapus produk?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: '{{ route('delete.stock', ':id') }}'.replace(':id', id),
                        data: formData,
                        success: function(data) {
                            if (data.success) {
                                if (data.deleted && data.stock === 1) {
                                    $('#product_' + id).hide('fast', function() {
                                        $(this).remove();
                                        updateTotal();
                                    });
                                    toast(data.message, 'success');

                                    location.reload();
                                } else {
                                    toast(data.message, 'error');
                                }
                            } else {
                                toast(data.message, 'error');
                            }
                        },
                        error: function(error) {
                            console.log('Error:', error);
                        }
                    });
                }
            });
        } else {
            performUpdate();
        }

        function performUpdate() {
            $.ajax({
                type: 'POST',
                url: '{{ route('stock.post', ':id') }}'.replace(':id', id),
                data: formData,
                success: function(data) {
                    if (data.deleted) {
                        $('#product_' + id).hide('fast', function() {
                            $(this).remove();
                            updateTotal();
                        });
                    } else {
                        $('#qty_' + id).text(data.qty);
                        updateTotal();
                    }
                },
                error: function(error) {
                    console.log('Error:', error);
                }
            });
        }
    }


    function refreshCart() {
        fetch('/cart-data')
            .then(response => response.json())
            .then(data => {
                console.log('Response from server:', data);

                document.getElementById('cartContainer').innerHTML = data.cartHtml;

                if (typeof updateTotal === 'function') {
                    updateTotal();
                }
            })
            .catch(error => {
                console.error('Error fetching cart data:', error);
            });
    }

    setInterval(refreshCart, 1000);

    function refreshElement() {
        var elemenTeks = document.getElementById("refreshText");
        fetch('/total-keranjang')
            .then(response => response.json())
            .then(data => {
                console.log('Response from server:', data);

                var formattedTotal = Number(data.total).toLocaleString('id-ID', { maximumFractionDigits: 2 });
                formattedTotal = formattedTotal.replace(/\.00$/, '');
                elemenTeks.innerHTML = "Rp. " + formattedTotal;
            })
            .catch(error => {
                console.error('Error fetching total:', error);
            });
    }

    setInterval(refreshElement, 1000);
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
