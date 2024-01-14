@extends('layouts.homepage')
@section('home')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-12">
            <div class="p-2 mb-3">
                <h4>Transaksi Anda <i class="bi bi-cart"></i></h4>
                <div class="d-flex flex-row align-items-center pull-right">
                    <span class="mr-1">Total transaksi : {{ $transaksi->count() }} transaksi</span>
                </div>
            </div>

            <div class="">
                <div class="table-responsive">
                    <table class="table" id="dataTable">
                        <thead>
                            <tr>
                                <th class="px-5 col-1">No</th>
                                <th>ID Transaksi</th>
                                <th>Nama Pelanggan</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($transaksi as $data)
                            <tr>
                                <td class="px-5 col-1">
                                    {{ $no++ }}
                                </td>
                                <td>{{ $data->id_transaksi }}</td>
                                <td>{{ $data->nama_pelanggan }}</td>
                                <td>
                                    @if($data->status == 'pending' || $data->status == 'payment')
                                        <span class="badge bg-warning">Menunggu</span>
                                    @elseif($data->status == 'proses')
                                        <span class="badge bg-primary">Dalam Proses</span>
                                    @elseif($data->status == 'selesai')
                                        <span class="badge bg-success">Telah diterima</span>
                                    @else
                                        <span class="badge bg-danger">Pesanan dibatalkan</span>
                                    @endif

                                </td>
                                <td>
                                    <a href="{{ route('transaksi.detail', $data->id_transaksi) }}" class="btn btn-primary">Detail</a>
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
@endsection
