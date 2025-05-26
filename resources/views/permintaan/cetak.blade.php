@extends('layouts.print')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2>LAPORAN PERMINTAAN ALAT TULIS KANTOR</h2>
                <h4>Periode: {{ $tanggal_mulai }} - {{ $tanggal_akhir }}</h4>
                <p>Status: {{ $status }}</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Pegawai</th>
                            <th>NIP</th>
                            <th>Status</th>
                            <th>Detail ATK</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permintaan as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ Carbon\Carbon::parse($p->created_at)->format('d/m/Y') }}</td>
                                <td>{{ $p->user->nama }}</td>
                                <td>{{ $p->user->nip }}</td>
                                <td>{{ ucfirst($p->status) }}</td>
                                <td>
                                    <ul>
                                        @foreach($p->detail as $d)
                                            <li>{{ $d->atk->nama_atk }} - {{ $d->jumlah }} {{ $d->satuan->nama_satuan }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data permintaan pada periode tersebut</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-6">
                <p>Jumlah Permintaan: {{ $permintaan->count() }}</p>
                <p>Menunggu: {{ $permintaan->where('status', 'menunggu')->count() }}</p>
                <p>Disetujui: {{ $permintaan->where('status', 'disetujui')->count() }}</p>
                <p>Ditolak: {{ $permintaan->where('status', 'ditolak')->count() }}</p>
            </div>
            <div class="col-6 text-end">
                <p>{{ date('d F Y') }}</p>
                <p>Bendahara ATK,</p>
                <br><br><br>
                <p>_______________________</p>
                <p>NIP.</p>
            </div>
        </div>
    </div>
@endsection