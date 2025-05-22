@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>

    <table class="w-full border border-gray-300 rounded-md overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Tanggal</th>
                <th class="px-4 py-2 text-left">Jam Masuk</th>
                <th class="px-4 py-2 text-left">Jam Keluar</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($absensi as $a)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $a->user->name }}</td>
                    <td class="px-4 py-2">{{ $a->tanggal }}</td>
                    <td class="px-4 py-2">{{ $a->jam_masuk }}</td>
                    <td class="px-4 py-2">{{ $a->jam_keluar }}</td>
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



