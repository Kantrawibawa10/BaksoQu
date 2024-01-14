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

@php
    $PendingTransaction = $transaksi->where('status', 'pending')->first();
    $PaymentTransaction = $transaksi->where('status', 'payment')->first();
    $ProsesTransaction = $transaksi->where('status', 'proses')->first();
@endphp
<div class="container mt-5 mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-8 mb-3">
            <div class="p-2">
                <h4>Checkout produk <i class="bi bi-cart"></i></h4>
                <div class="d-flex flex-row align-items-center pull-right">
                    <span class="mr-1">Pesanan anda :</span>
                </div>
            </div>

            @if(isset($transaksi) && $transaksi->count() > 0)
            @foreach ($transaksi as $data)
            <div class="d-flex flex-row flex-wrap justify-content-between align-items-center p-2 bg-white mt-4 px-3 rounded shadow">
                <div class="mr-1 mb-3 mt-3 col-lg-1 col-md-2 col-6">
                    <img class="rounded img-fluid" src="{{ asset('drive/produk/'. $data->photo) }}" alt="Product Image">
                </div>

                <div class="d-flex flex-column align-items-center product-details mb-3 mt-3 col-lg-4 col-md-4 col-12">
                    <span class="font-weight-bold text-center text-capitalize">{{ $data->nama_produk }}</span>
                    <div class="size text-center">
                        <span class="text-grey">Kategori:</span>
                        <span class="font-weight-bold">&nbsp; {{ $data->kategori_produk }}</span>
                    </div>
                </div>

                <div class="d-flex flex-row align-items-center qty mb-3 mt-3 col-lg-3 col-md-4 col-12">
                    <h5 class="text-grey mt-1 mr-1 ml-1 text-center">
                        {{ $data->qty }}<span style="color: gray; font-size: 15px;">/pcs</span>
                    </h5>&nbsp;&nbsp;
                </div>

                <div class="mb-2 col-lg-3 col-md-2 col-12">
                    <h6 class="text-dark m-auto text-end">Rp. {{ number_format($data->harga_produk) }}<span
                            style="color: gray; font-size: 12px;">/pcs</span></h6>
                </div>
            </div>
            @endforeach
            @else
            <div class="col-lg-12 col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body d-flex justify-content-center">
                        <div>
                            <img src="{{ URL::to('assets/img/loader/cart.gif') }}" width="200">
                            <p class="text-center">Transaksi anda kosong</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="d-flex flex-row justify-content-between align-items-center mt-3 p-3 bg-white rounded shadow">
                <span class="text-secondary text-start">Total Transaksi:</span>
                <span class="text-secondary text-end">Rp. {{ number_format($transaksi->sum('harga_produk')) }}</span>
            </div>

            @if($PendingTransaction)
            <div id="timerContainer" class="d-flex flex-row justify-content-between align-items-center mt-3 p-3 rounded shadow bg-success">
                <span class="text-white text-start">Waktu Pembayaran:</span>
                <span id="timer" class="text-white text-end"></span>
            </div>

            <button id="resetButton" class="btn btn-primary mt-3 text-end" style="display: none;" onclick="resetTimer()">Buka ulang pembayaran <i class="bi bi-clock-history"></i></button>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card shadow p-2 bg-white rounded border-none">
                @if($PendingTransaction)
                    <div class="card-body">
                        <h5>Metode Pembayaran</h5>
                        <div class="mb-3">
                            <span><img src="{{ asset('assets/bank/bri.png') }}" alt="bank bri" width="100"></span>
                            <p class="mb-2"><b>I Made Adi Guna</b> <br> <span class="text-secondary">1555-02-009995-63-9</span></p>
                        </div>

                        <div class="mb-3">
                            <span><img src="{{ asset('assets/bank/bca.png') }}" alt="bank bri" width="100"></span>
                            <p class="mb-2"><b>I Made Adi Guna</b> <br> <span class="text-secondary">1555-02-009995-63-9</span></p>
                        </div>

                        <div id="briButton">
                            <form action="{{ route('transaksi.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="hidden" name="id_transaksi" value="{{ $PendingTransaction->id_transaksi }}">
                                    <input type="file" accept="image/*" class="form-control @error ('transfer') is-invalid @enderror" name="transfer">
                                    @error('transfer')
                                        <small class="form-text text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary col-12" >Bayar Sekarang</button>
                            </form>
                        </div>
                    </div>
                @elseif($PaymentTransaction)
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/bank/succespay.gif') }}" alt="" width="300" class="img-fluid mb-0">
                        <h5 class="h3 text-gray-900 mb-2 mt-2">Memproses Pembayaran</h5>
                        <p>Menunggu Pembayaran di terima admin kami...</p>
                        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kehalaman transaksi</a>
                    </div>
                @elseif($ProsesTransaction)
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/bank/otw.gif') }}" alt="" width="300" class="img-fluid mb-0">
                        <h5 class="h3 text-gray-900 mb-2 mt-2">Pesanan Meluncur</h5>
                        <p>Pesanan anda sedang menuju kelokasi anda...</p>
                        <a href="{{ route('transaksi.index') }}" class="btn btn-primary">Kehalaman transaksi</a>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>

<script>
    var targetDate;
    var timerInterval;

    // Function to start or reset the timer
    function startTimer() {
        // Set the target date to 1x24 hours from now
        targetDate = new Date();
        targetDate.setHours(targetDate.getHours() + 24);

        // Update the timer every second
        timerInterval = setInterval(updateTimer, 1000);

        // Hide the reset button
        document.getElementById('resetButton').style.display = 'none';

        // Show the payment buttons
        document.getElementById('briButton').style.display = 'block';
    }

    // Function to update the timer
    function updateTimer() {
        // Get the current date and time
        var currentDate = new Date();

        // Calculate the remaining time
        var timeDifference = targetDate - currentDate;

        // Check if the target date has passed
        if (timeDifference <= 0) {
            clearInterval(timerInterval); // Stop the timer
            document.getElementById('timer').innerHTML = "Expired";

            // Change background color to danger
            document.getElementById('timerContainer').classList.add('bg-danger');

            // Hide the reset button
            document.getElementById('resetButton').style.display = 'block';

            // Hide the payment buttons
            document.getElementById('briButton').style.display = 'none';
        } else {
            // Calculate remaining hours, minutes, and seconds
            var hours = Math.floor(timeDifference / (1000 * 60 * 60));
            var minutes = Math.floor((timeDifference % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((timeDifference % (1000 * 60)) / 1000);

            // Format the time and update the HTML
            document.getElementById('timer').innerHTML = hours + "h " + minutes + "m " + seconds + "s";
        }
    }

    // Function to reset the timer
    function resetTimer() {
        clearInterval(timerInterval); // Stop the current timer
        startTimer(); // Start a new timer

        // Remove background color
        document.getElementById('timerContainer').classList.remove('bg-danger');

        // Hide the reset button
        document.getElementById('resetButton').style.display = 'none';

        // Show the payment buttons
        document.getElementById('briButton').style.display = 'block';
    }

    // Function to handle payment button click
    function handlePayment(bank) {
        alert('Payment initiated for ' + bank);
    }

    // Start the timer when the page loads
    window.onload = startTimer;
</script>


@endsection
