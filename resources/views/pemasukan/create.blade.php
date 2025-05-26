@extends('layouts.app')
@section('content')
    <div class="container-fluid px-4">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-lg-10">
                <!-- Header Section -->
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-success rounded-3 p-3 me-3"
                            style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-plus text-white"></i>
                        </div>
                        <div>
                            <h4 class="mb-1 fw-bold">Tambah Pemasukan ATK</h4>
                            <small class="text-muted">Catat pemasukan alat tulis kantor</small>
                        </div>
                    </div>
                    <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                </div>

                <!-- Main Form Card -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <form action="{{ route('pemasukan.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <!-- ATK Selection -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-tag text-primary me-1"></i>Nama ATK <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select name="atk_id" class="form-select" required>
                                        <option value="">-- Pilih ATK --</option>
                                        @foreach($atkList as $atk)
                                            <option value="{{ $atk->id }}">{{ $atk->nama_atk }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Satuan Selection -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-balance-scale text-primary me-1"></i>Satuan <span
                                            class="text-danger">*</span>
                                    </label>
                                    <select name="satuan_id" class="form-select" required>
                                        <option value="">-- Pilih Satuan --</option>
                                        @foreach($satuanList as $satuan)
                                            <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Jumlah -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-hashtag text-primary me-1"></i>Jumlah <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="jumlah" class="form-control" placeholder="Masukkan jumlah"
                                        min="1" required>
                                </div>

                                <!-- Total Biaya -->
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-money-bill-wave text-primary me-1"></i>Total Biaya <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="total_biaya" class="form-control"
                                        placeholder="Masukkan total biaya" min="0" required>
                                </div>

                                <!-- Tanggal Masuk -->
                                <div class="col-12">
                                    <label class="form-label fw-medium">
                                        <i class="fas fa-calendar text-primary me-1"></i>Tanggal Masuk <span
                                            class="text-danger">*</span>
                                    </label>
                                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-end gap-2 mt-4 pt-3 border-top">
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="fas fa-undo me-1"></i>Reset
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i>Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Quick Tips -->
                <div class="alert alert-info border-0 mt-3">
                    <div class="d-flex">
                        <i class="fas fa-info-circle me-2 mt-1"></i>
                        <div>
                            <strong>Tips:</strong> Pastikan data ATK, jumlah, dan biaya sudah benar sebelum menyimpan.
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

        .btn-success {
            background: linear-gradient(135deg, #198754, #146c43);
            border: none;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #146c43, #0f5132);
            transform: translateY(-1px);
        }

        @media (max-width: 768px) {
            .d-flex.justify-content-between {
                flex-direction: column;
                gap: 1rem;
            }
        }
    </style>
@endsection