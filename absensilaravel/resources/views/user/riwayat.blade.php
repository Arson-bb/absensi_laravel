@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Riwayat Absensi</h2>
    <table border="1" cellpadding="5">
        <tr>
            <th>Tanggal</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
        </tr>
        @foreach($riwayat as $absen)
            <tr>
                <td>{{ $absen->tanggal }}</td>
                <td>{{ $absen->jam_masuk ?? '-' }}</td>
                <td>{{ $absen->jam_keluar ?? '-' }}</td>
            </tr>
        @endforeach
    </table>

    <br>
    <a href="/user/dashboard">Kembali ke Dashboard</a>
</div>
@endsection
