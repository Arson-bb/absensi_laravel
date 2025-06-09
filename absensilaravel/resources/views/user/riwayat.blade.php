@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <h1 class="text-xl font-semibold mb-4">Riwayat Absensi</h1>

    <div class="overflow-x-auto rounded shadow bg-white">
        <table class="min-w-full border text-sm">
            <thead class="bg-gray-100 border-b">
                <tr class="text-left">
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Jam Masuk</th>
                    <th class="px-4 py-2">Jam Keluar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($riwayat as $a)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $a->tanggal }}</td>
                        <td class="px-4 py-2">{{ $a->jam_masuk }}</td>
                        <td class="px-4 py-2">{{ $a->jam_keluar ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center px-4 py-2 text-gray-500">Belum ada data absensi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kembali ke Dashboard
        </a>
    </div>
</div>
@endsection