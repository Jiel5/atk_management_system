@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Tambah Satuan</strong></div>
        <div class="card-body">
            <form action="{{ route('satuan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama Satuan</label>
                    <input type="text" name="nama_satuan" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection