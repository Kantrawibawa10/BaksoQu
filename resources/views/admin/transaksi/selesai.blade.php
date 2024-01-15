@extends('layouts.admin')
@section('body')
<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon warning">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Transaksi Selesai</h4>
                        </div>
                        <div class="card-body">
                            {{ $selesai->count() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-lg-8">
                                    <h4>Pesanan selesai</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="px-5 col-1">No</th>
                                                <th>ID Transaksi</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Status</th>
                                                <th>User Acc</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($selesai as $data)
                                            <tr>
                                                <td class="px-5 col-1">
                                                    {{ $no++ }}
                                                </td>
                                                <td>{{ $data->id_transaksi }}</td>
                                                <td>{{ $data->nama_pelanggan }}</td>
                                                <td><span class="badge text-white" style="background: rgb(31, 92, 9);">Pesanan selesai</span></td>
                                                <td>{{ $data->user_acc ?? 'Tidak ada' }}</td>
                                                <td>
                                                    <div class="tooltip-container">
                                                        <a type="button" data-toggle="modal" data-target="#invoice{{ $data->id_transaksi }}" class="p-0 ml-1" style="color: rgb(0, 106, 255); font-size: 25px; cursor: pointer;"><ion-icon name="receipt-outline"></ion-icon></a>
                                                        <span class="tooltip-text">Transaksi Pelanggan</span>
                                                    </div>

                                                    <div class="tooltip-container">
                                                        <a type="button" data-toggle="modal" data-target="#bayar{{ $data->id_transaksi }}" class="p-0 ml-1" style="color: rgb(17, 97, 38); font-size: 25px; cursor: pointer;"><ion-icon name="cash-outline"></ion-icon></a>
                                                        <span class="tooltip-text">Pembayaran</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach($selesai as $item)
    <div class="modal fade" tabindex="-1" role="dialog" id="invoice{{ $item->id_transaksi }}">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Header -->
                <div class="modal-header">
                    <h5 class="modal-title">Invoice {{ $item->id_invoice }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- /Header -->

                <!-- Body -->
                <div class="modal-body" id="print-content{{ $item->id_transaksi }}">
                    <div class="row align-items-center justify-content-center bg-white mt-0" style="min-height: 100vh;">
                        <div>
                            <div class="text-center mb-3">
                                <p class="mb-0 pb-0"><strong>BaksoQu</strong></p>
                                <p>PT. IndoJaya Food</p>
                            </div>
                            <hr>
                            <div class="mb-3">
                                <p class="mb-0"><strong>Invoice :</strong> {{ $item->id_invoice }}</p>
                                <p class="mb-0"><strong>Nama :</strong> {{ $item->nama_pelanggan }}</p>
                                <p><strong>Tanggal :</strong> {{ \Carbon\Carbon::parse($item->tgl_transaksi)->isoFormat('LL') }}</p>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Produk</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataTransaksi as $trx)
                                    @if($trx->id_transaksi === $item->id_transaksi)
                                    <tr>
                                        <td>{{ $trx->nama_produk }}</td>
                                        <td>{{ $trx->qty }}x</td>
                                        <td>Rp. {{ number_format($data->harga_produk) }}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="table-info">
                                        <td></td>
                                        <td class="text-right"><strong>Total</strong></td>
                                        <td><strong>Rp. {{ number_format($data->sum('harga_produk')) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                            <hr>
                            <div class="text-center col-12 align-items-center mt-3">
                                <p class="mb-0">Terima kasih telah berbelanja</p>
                                <p class="mb-0">Jl. Mawar No.36, Delod Peken, Kec. Tabanan, <br> Kabupaten Tabanan, Bali 82121</p>
                                <p class="mb-0">087894561212</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Body -->

                <!-- Footer -->
                <div class="modal-footer no-print">
                    <button type="button" class="btn btn-primary no-print" onclick="printInvoice('{{ $item->id_transaksi }}')">Print</button>
                </div>
                <!-- /Footer -->
            </div>
        </div>
    </div>
@endforeach

@foreach($selesai as $item)
<div class="modal fade" tabindex="-1" role="dialog" id="bayar{{ $item->id_transaksi }}">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title">Bukti Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- /Header -->

            <!-- Body -->
            <div class="modal-body">
                <img src="{{ asset('drive/transfer/'. $item->transfer) }}" class="img-fluid">
            </div>
            <!-- /Body -->
        </div>
    </div>
</div>
@endforeach


<script>
    function printInvoice(invoiceId) {
        var printContents = document.getElementById('print-content' + invoiceId).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endsection
