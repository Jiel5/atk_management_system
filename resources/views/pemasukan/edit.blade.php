@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <!-- Header Section -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-warning rounded-3 p-3 me-3"
                            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-edit text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold">Edit Pemasukan ATK</h4>
                            <small class="text-muted">Ubah data pemasukan alat tulis kantor</small>
                        </div>
                    </div>
                    <a href="{{ route('pemasukan.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>

                <!-- Main Form Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('pemasukan.update', $pemasukan->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row g-3">
                                <!-- ATK Selection -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-tag text-primary me-1"></i>Nama ATK <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select name="atk_id" class="form-select @error('atk_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih ATK --</option>
                                        @foreach($atkList as $atk)
                                            <option value="{{ $atk->id }}" 
                                                {{ old('atk_id', $pemasukan->atk_id) == $atk->id ? 'selected' : '' }}>
                                                {{ $atk->nama_atk }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('atk_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Satuan Selection -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-balance-scale text-primary me-1"></i>Satuan <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select name="satuan_id" class="form-select @error('satuan_id') is-invalid @enderror" required>
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach($satuanList as $satuan)
                                            <option value="{{ $satuan->id }}" 
                                                {{ old('satuan_id', $pemasukan->satuan_id) == $satuan->id ? 'selected' : '' }}>
                                                {{ $satuan->nama_satuan }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('satuan_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Jumlah -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-hashtag text-primary me-1"></i>Jumlah <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="jumlah" 
                                        class="form-control @error('jumlah') is-invalid @enderror" 
                                        placeholder="Masukkan jumlah"
                                        value="{{ old('jumlah', $pemasukan->jumlah) }}"
                                        min="1" required>
                                    @error('jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Total Biaya -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-money-bill-wave text-primary me-1"></i>Total Biaya <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="total_biaya" 
                                        class="form-control @error('total_biaya') is-invalid @enderror"
                                        placeholder="Masukkan total biaya" 
                                        value="{{ old('total_biaya', $pemasukan->total_biaya) }}"
                                        min="0" required>
                                    @error('total_biaya')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Tanggal Masuk -->
                                <div class="col-12">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-calendar text-primary me-1"></i>Tanggal Masuk <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="tanggal_masuk" 
                                        class="form-control @error('tanggal_masuk') is-invalid @enderror" 
                                        value="{{ old('tanggal_masuk', $pemasukan->tanggal_masuk ? \Carbon\Carbon::parse($pemasukan->tanggal_masuk)->format('Y-m-d') : '') }}"
                                        required>
                                    @error('tanggal_masuk')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <a href="{{ route('pemasukan.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times me-1"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-warning text-white">
                                    <i class="fas fa-save me-1"></i>Perbarui
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Current Data Info -->
                <div class="alert alert-light border mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">Data Saat Ini:</small>
                            <div class="d-flex flex-wrap gap-3">
                                <span class="badge bg-secondary">{{ $pemasukan->atk->nama_atk ?? 'N/A' }}</span>
                                <span class="badge bg-secondary">{{ $pemasukan->jumlah }} {{ $pemasukan->satuan->nama_satuan ?? '' }}</span>
                                <span class="badge bg-secondary">Rp {{ number_format($pemasukan->total_biaya, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <div class="col-md-6 mt-2 mt-md-0">
                            <small class="text-muted d-block mb-1">Tanggal Masuk:</small>
                            <span class="badge bg-info">{{ $pemasukan->tanggal_masuk ? \Carbon\Carbon::parse($pemasukan->tanggal_masuk)->format('d/m/Y') : 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Warning if used -->
                @if(isset($sudahDipakai) && $sudahDipakai)
                    <div class="alert alert-warning border-0 mt-3">
                        <div class="d-flex">
                            <i class="fas fa-exclamation-triangle me-2 mt-1"></i>
                            <div>
                                <strong>Peringatan:</strong> ATK ini sudah pernah digunakan dalam permintaan yang disetujui. 
                                Perubahan data mungkin akan mempengaruhi laporan yang sudah ada.
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Tips -->
                <div class="alert alert-info border-0 mt-3">
                    <div class="d-flex">
                        <i class="fas fa-info-circle me-2 mt-1"></i>
                        <div>
                            <strong>Tips:</strong> Pastikan data yang diubah sudah benar sebelum menyimpan. 
                            Perubahan akan mempengaruhi stok dan laporan terkait.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-select:focus,
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107, #ffab00);
            border: none;
        }

        .btn-warning:hover {
            background: linear-gradient(135deg, #ffab00, #ff8f00);
            transform: translateY(-1px);
        }

        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
        }

        @media (max-width: 768px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endsection