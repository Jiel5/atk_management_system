@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Tambah ATK</strong></div>
        <div class="card-body">
            <form action="{{ route('atk.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Nama ATK</label>
                    <input type="text" name="nama_atk" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih --</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
@endsection