@extends('layouts.admin')
@section('body')
<div class="main-content">
    <section classs="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon warning">
                        <i class="fas fa-filter"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Kategori</h4>
                        </div>
                        <div class="card-body">
                            {{ $kategori->count() }}
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
                                    <h4>Kategori Produk</h4>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <a href="{{ route('kategori.create') }}"
                                        class="btn btn-warning warning text-white rounded-0">Tambah Kategori <i
                                            class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Nama Kategori</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $no = 1;
                                            @endphp
                                            @foreach ($kategori as $data)
                                            <tr>
                                                <td class="text-center">
                                                    {{ $no++ }}
                                                </td>
                                                <td class="text-capitalize">{{ $data->kategori_produk }}</td>
                                                <td>
                                                    <a href="{{ route('kategori.edit', $data->id) }}"
                                                        class="btn btn-info"><i class="fas fa-edit"></i> Edit</a>
                                                    <form id="deleteForm"
                                                        action="{{ route('kategori.destroy', $data->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger delete-button"><i
                                                                class="fas fa-trash"></i> Hapus</button>
                                                    </form>
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
