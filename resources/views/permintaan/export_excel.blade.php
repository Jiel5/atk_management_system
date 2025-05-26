<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Nama</th>
            <th>NIP</th>
            <th>Status</th>
            <th>Detail</th>
        </tr>
    </thead>
    <tbody>
        @foreach($permintaan as $p)
            <tr>
                <td>{{ $p->created_at->format('d/m/Y') }}</td>
                <td>{{ $p->user->nama }}</td>
                <td>{{ $p->user->nip }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>
                    @foreach($p->detail as $d)
                        - {{ $d->atk->nama_atk }} ({{ $d->jumlah }} {{ $d->satuan->nama_satuan }})<br>
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>