@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary">Daftar Pengguna</h5>
            <a href="{{ route('pengguna.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Tambah Pengguna
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table id="usersTable" class="table table-bordered table-hover" style="width:100%; color: #333;">
                    <thead class="table-light" style="color: #212529; font-weight: 600;">
                        <tr>
                            <th class="text-nowrap">Nama</th>
                            <th class="text-nowrap">Username</th>
                            <th class="text-nowrap">NIP</th>
                            <th class="text-nowrap">Nomor HP</th>
                            <th class="text-nowrap">Email</th>
                            <th class="text-nowrap">Jabatan</th>
                            <th class="text-nowrap">Role</th>
                            <th class="text-nowrap text-center" style="width: 150px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td class="text-nowrap">{{ $u->nama }}</td>
                                <td class="text-nowrap">{{ $u->username }}</td>
                                <td class="text-nowrap">{{ $u->nip }}</td>
                                <td class="text-nowrap">{{ $u->no_hp }}</td>
                                <td class="text-nowrap">{{ $u->email }}</td>
                                <td class="text-nowrap">{{ $u->jabatan }}</td>
                                <td class="text-nowrap">
                                    @if($u->role == 'bendahara')
                                        <span class="badge bg-info">Bendahara</span>
                                    @else
                                        <span class="badge bg-secondary">User</span>
                                    @endif
                                </td>
                                <td class="text-nowrap text-center">
                                    <a href="{{ route('pengguna.edit', $u->id) }}" class="btn btn-warning btn-sm me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $u->id }}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal{{ $u->id }}" tabindex="-1"
                                        aria-labelledby="deleteModalLabel{{ $u->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $u->id }}">Konfirmasi Hapus
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Apakah Anda yakin ingin menghapus pengguna
                                                        <strong>{{ $u->nama }}</strong>?
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <form action="{{ route('pengguna.destroy', $u->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">
                                    <div class="alert alert-info mb-0">
                                        <i class="fas fa-info-circle me-1"></i> Tidak ada data pengguna.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#usersTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json'
                },
                responsive: true,
                pageLength: 10,
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
                columnDefs: [
                    { orderable: false, targets: 7 }
                ]
            });
        });
    </script>
@endsection