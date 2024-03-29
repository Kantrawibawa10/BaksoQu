@extends('layouts.admin')
@section('body')

<div class="main-content">
    <section class="section">
        <div class="row">
            <div class="section-header">
                <h1>Roles Users</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Data users</a></div>
                    <div class="breadcrumb-item">Users</div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row">
                                <div class="col-lg-8">
                                    <h4>Roles Users</h4>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <a href="{{ route('roles.create') }}"
                                        class="btn btn-warning warning text-white rounded-0">Tambah Roles <i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="dataTable">
                                        <thead>
                                            <tr>
                                                <th class="px-5 col-1">No</th>
                                                <th>Roles</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp
                                            @foreach ($kategori as $data)
                                            <tr>
                                                <td class="px-5 col-1">
                                                    {{ $no++ }}
                                                </td>
                                                <td class="text-capitalize">{{ $data->kategori_produk }}</td>
                                                <td>
                                                    <div class="tooltip-container">
                                                        <a href="{{ route('kategori.edit', $data->id) }}" class="p-0s" style="color: blue; font-size: 25px;"><ion-icon name="create-outline"></ion-icon></a>
                                                        <span class="tooltip-text">Edit</span>
                                                    </div>
                                                    <div class="tooltip-container">
                                                        <form id="deleteForm"
                                                            action="{{ route('kategori.destroy', $data->id) }}"
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
