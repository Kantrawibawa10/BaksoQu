@extends('layouts.admin')
@section('body')

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon warning">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pelanggan</h4>
                        </div>
                        <div class="card-body">
                            {{ $pelanggan->count() }}
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
                                    <h4>Register Pelanggan</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="px-5 col-1">No</th>
                                                <th>Nama Pelanggan</th>
                                                <th>Telepon</th>
                                                <th>Alamat</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($pelanggan as $data)
                                            <tr>
                                                <td class="px-5 col-1">
                                                    {{ $no++ }}
                                                </td>
                                                <td>{{ $data->nama }}</td>
                                                <td class="text-capitalize">{{ $data->no_telepon }}</td>
                                                <td class="text-capitalize">{{ $data->alamat }}</td>
                                                <td>
                                                    <div class="tooltip-container">
                                                        <a href="{{ route('pelanggan.show', $data->id) }}" class="p-0s" style="color: rgb(0, 136, 255); font-size: 25px;"><ion-icon name="eye-outline"></ion-icon></a>
                                                        <span class="tooltip-text">Detail</span>
                                                    </div>
                                                    <div class="tooltip-container">
                                                        <form id="deleteForm"
                                                            action="{{ route('pelanggan.destroy', $data->id) }}"
                                                            method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button" class="p-0 delete-button" style="outline: none; color: red; border: none; background: transparent; font-size: 25px; cursor: pointer;"><ion-icon name="trash-outline"></ion-icon></button>
                                                            <span class="tooltip-text">Hapus</span>
                                                        </form>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
    document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const deleteForm = document.getElementById('deleteForm');
                const deleteUrl = deleteForm.getAttribute('action');

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
                        deleteForm.style.display = 'none';

                        // Lakukan penghapusan dengan mengirimkan formulir
                        deleteForm.submit();
                    }
                });
            });
        });
</script>
@endsection
