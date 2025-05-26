@extends('layouts.app')
@section('content')
    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">
            <div class="d-flex align-items-center">
                <div class="bg-info rounded-circle p-2 me-3">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
                <div>
                    <h4 class="mb-0 fw-bold">Detail Permintaan</h4>
                    <small class="text-muted">Informasi lengkap permintaan ATK</small>
                </div>
            </div>
        </div>
        <div class="col-auto">
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <!-- Info Pemohon -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">
                        <h6 class="text-muted mb-3 fw-semibold">
                            <i class="fas fa-user me-2"></i>Informasi Pemohon
                        </h6>
                        <div class="row g-2">
                            <div class="col-4">
                                <small class="text-muted">Nama:</small>
                            </div>
                            <div class="col-8">
                                <span class="fw-medium">{{ $permintaan->user->nama }}</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted">Jabatan:</small>
                            </div>
                            <div class="col-8">
                                <span>{{ $permintaan->user->jabatan }}</span>
                            </div>
                            <div class="col-4">
                                <small class="text-muted">NIP:</small>
                            </div>
                            <div class="col-8">
                                <span class="text-muted">{{ $permintaan->user->nip }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="border rounded-3 p-3 bg-light">
                        <h6 class="text-muted mb-3 fw-semibold">
                            <i class="fas fa-calendar me-2"></i>Informasi Permintaan
                        </h6>
                        <div class="row g-2">
                            <div class="col-5">
                                <small class="text-muted">Tanggal:</small>
                            </div>
                            <div class="col-7">
                                <span class="fw-medium">{{ $permintaan->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="col-5">
                                <small class="text-muted">Waktu:</small>
                            </div>
                            <div class="col-7">
                                <span>{{ $permintaan->created_at->format('H:i') }}</span>
                            </div>
                            <div class="col-5">
                                <small class="text-muted">Status:</small>
                            </div>
                            <div class="col-7">
                                @php
                                    $statusClass = [
                                        'menunggu' => 'warning',
                                        'disetujui' => 'success',
                                        'ditolak' => 'danger'
                                    ];
                                    $statusIcon = [
                                        'menunggu' => 'clock',
                                        'disetujui' => 'check-circle',
                                        'ditolak' => 'times-circle'
                                    ];
                                    $class = $statusClass[$permintaan->status] ?? 'secondary';
                                    $icon = $statusIcon[$permintaan->status] ?? 'question';
                                @endphp
                                <span
                                    class="badge bg-{{ $class }} bg-opacity-10 text-{{ $class }} px-2 py-1 rounded-pill border border-{{ $class }} border-opacity-25">
                                    <i class="fas fa-{{ $icon }} me-1"></i> {{ ucfirst($permintaan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar ATK -->
            <div class="mb-3">
                <h6 class="text-muted mb-3 fw-semibold">
                    <i class="fas fa-list me-2"></i>Daftar ATK yang Diminta
                    <span class="badge bg-primary ms-2">{{ $permintaan->detailPermintaan->count() }} item</span>
                </h6>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 py-3">
                                <small class="text-muted fw-semibold">NO</small>
                            </th>
                            <th class="border-0 py-3">
                                <small class="text-muted fw-semibold">NAMA ATK</small>
                            </th>
                            <th class="border-0 py-3 text-center">
                                <small class="text-muted fw-semibold">JUMLAH</small>
                            </th>
                            <th class="border-0 py-3">
                                <small class="text-muted fw-semibold">SATUAN</small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($permintaan->detailPermintaan as $d)
                            <tr class="border-bottom">
                                <td class="py-3">
                                    <span class="text-muted">{{ $loop->iteration }}</span>
                                </td>
                                <td class="py-3">
                                    <span class="fw-medium">{{ $d->atk->nama_atk }}</span>
                                </td>
                                <td class="py-3 text-center">
                                    <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                        {{ $d->jumlah }}
                                    </span>
                                </td>
                                <td class="py-3">
                                    <span class="text-muted">{{ $d->satuan->nama_satuan }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection