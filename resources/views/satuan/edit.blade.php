@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Edit Satuan</strong></div>
        <div class="card-body">
            <form action="{{ route('satuan.update', $satuan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Nama Satuan</label>
                    <input type="text" name="nama_satuan" value="{{ $satuan->nama_satuan }}" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('satuan.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
@endsection