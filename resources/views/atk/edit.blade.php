@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"><strong>Edit ATK</strong></div>
        <div class="card-body">
            <form action="{{ route('atk.update', $atk->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label>Nama ATK</label>
                    <input type="text" name="nama_atk" class="form-control" value="{{ $atk->nama_atk }}" required>
                </div>
                <div class="mb-3">
                    <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                        @foreach($kategori as $item)
                            <option value="{{ $item->id }}" {{ $atk->kategori_id == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection