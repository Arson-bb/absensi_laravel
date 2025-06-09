@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <h2 class="text-2xl font-semibold mb-4">Riwayat Absensi</h2>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-300 rounded grid grid-cols-1 md:grid-cols-2 gap-4">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2">Tanggal</th>
                <th class="px-4 py-2">Waktu Masuk</th>
                <th class="px-4 py-2">Waktu Keluar</th>
                <th class="px-4 py-2">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensis as $absen)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($absen->created_at)->format('d M Y') }}</td>
                    <td class="px-4 py-2">{{ $absen->jam_masuk ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $absen->jam_keluar ?? '-' }}</td>
                    <td class="px-4 py-2">{{ $absen->keterangan ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada data absensi.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection

