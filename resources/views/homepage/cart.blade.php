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
                @include('data.cart')
            </div>

            <div class="d-flex flex-row justify-content-between align-items-center mt-3 p-3 bg-white rounded shadow">
                <span class="text-secondary text-start">Total Transaksi:</span>
                <span id="refreshText" class="text-secondary text-end">Rp. {{ number_format($cart->sum('harga')) }}</span>
            </div>

            @if(isset($cart) && $cart->count() > 0)
                <div class="d-flex flex-row align-items-center mt-3 p-2 bg-white rounded shadow">
                    <button class="btn btn-success btn-block btn-lg ml-2 pay-button" type="button">Checkout <i class="bi bi-cash"></i></button>
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
