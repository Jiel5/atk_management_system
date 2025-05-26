@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Header -->
            <div class="d-flex align-items-center mb-4">
                <i class="fas fa-clipboard-list text-primary fs-3 me-3"></i>
                <div>
                    <h4 class="mb-0">Ajukan Permintaan ATK</h4>
                    <small class="text-muted">Buat permintaan alat tulis kantor</small>
                </div>
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary ms-auto">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>

            <!-- Form -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <i class="fas fa-edit me-2"></i>Form Permintaan
                    <span class="badge bg-light text-primary ms-2" id="counter">1 Item</span>
                </div>

                <div class="card-body">
                    <form action="{{ route('permintaan.store') }}" method="POST">
                        @csrf

                        <div id="items-container">
                            <div class="item-group border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Item #<span class="item-number">1</span></h6>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-item d-none">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">ATK <span class="text-danger">*</span></label>
                                        <select name="atk_id[]" class="form-select atk-select" required>
                                            <option value="">Pilih ATK</option>
                                            @foreach($atkList as $atk)
                                                <option value="{{ $atk->id }}" data-stok="{{ $atk->stok->sum('jumlah') }}"
                                                    data-satuan="{{ $atk->stok->first()?->satuan->nama_satuan ?? '-' }}">
                                                    {{ $atk->nama_atk }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted stok-info">Stok tersedia: -</small>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                        <input type="number" name="jumlah[]" class="form-control" min="1" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">Satuan <span class="text-danger">*</span></label>
                                        <select name="satuan_id[]" class="form-select" required>
                                            <option value="">Pilih Satuan</option>
                                            @foreach($satuanList as $satuan)
                                                <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <button type="button" class="btn btn-outline-primary" id="add-item">
                                <i class="fas fa-plus"></i> Tambah Item
                            </button>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane"></i> Ajukan Permintaan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let itemCount = 1;
            const container = document.getElementById('items-container');
            const counter = document.getElementById('counter');

            function createItem(number) {
                return `
                    <div class="item-group border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Item #<span class="item-number">${number}</span></h6>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-item">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">ATK <span class="text-danger">*</span></label>
                                <select name="atk_id[]" class="form-select atk-select" required>
                                    <option value="">Pilih ATK</option>
                                    @foreach($atkList as $atk)
                                        <option value="{{ $atk->id }}"
                                            data-stok="{{ $atk->stok->sum('jumlah') }}"
                                            data-satuan="{{ $atk->stok->first()?->satuan->nama_satuan ?? '-' }}">
                                            {{ $atk->nama_atk }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted stok-info">Stok tersedia: -</small>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jumlah <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah[]" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Satuan <span class="text-danger">*</span></label>
                                <select name="satuan_id[]" class="form-select" required>
                                    <option value="">Pilih Satuan</option>
                                    @foreach($satuanList as $satuan)
                                        <option value="{{ $satuan->id }}">{{ $satuan->nama_satuan }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                `;
            }

            // Tambah item
            document.getElementById('add-item').addEventListener('click', function () {
                itemCount++;
                container.insertAdjacentHTML('beforeend', createItem(itemCount));
                updateCounter();
                updateRemoveButtons();
            });

            // Hapus item
            container.addEventListener('click', function (e) {
                if (e.target.closest('.remove-item')) {
                    e.target.closest('.item-group').remove();
                    updateNumbers();
                    updateCounter();
                    updateRemoveButtons();
                }
            });

            function updateNumbers() {
                document.querySelectorAll('.item-number').forEach((el, index) => {
                    el.textContent = index + 1;
                });
                itemCount = document.querySelectorAll('.item-group').length;
            }

            function updateCounter() {
                const count = document.querySelectorAll('.item-group').length;
                counter.textContent = count + ' Item';
            }

            function updateRemoveButtons() {
                const items = document.querySelectorAll('.item-group');
                const removeButtons = document.querySelectorAll('.remove-item');

                removeButtons.forEach(btn => {
                    btn.classList.toggle('d-none', items.length === 1);
                });
            }
            // Fungsi untuk update info stok
            function updateStokInfo(selectEl) {
                const selectedOption = selectEl.options[selectEl.selectedIndex];
                const stok = selectedOption.getAttribute('data-stok');
                const satuan = selectedOption.getAttribute('data-satuan');
                const stokInfo = selectEl.closest('.col-md-6').querySelector('.stok-info');

                if (stokInfo) {
                    stokInfo.textContent = `Stok tersedia: ${stok ?? 0} ${satuan ?? ''}`;
                }
            }

            // Listener global untuk dropdown ATK
            document.addEventListener('change', function (e) {
                if (e.target.classList.contains('atk-select')) {
                    updateStokInfo(e.target);
                }
            });

        }); 
    </script>


    <style>
        .item-group {
            transition: all 0.3s ease;
        }

        .item-group:hover {
            border-color: #0d6efd !important;
        }
    </style>
@endsection