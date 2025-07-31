@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-semibold mb-6">Absensi</h2>

    @if (session('error'))
        <div class="bg-red-100 text-red-800 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif
    
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <form action="{{ route('user.absen.masuk') }}" method="POST" class="bg-white border p-4 rounded shadow">
            @csrf
            <h3 class="font-semibold mb-2">Absen Masuk</h3>
            <div class="mb-3">
                <label for="keterangan_masuk" class="block text-sm font-medium">Keterangan</label>
                <input type="text" name="keterangan_masuk" id="keterangan_masuk" class="w-full border rounded px-3 py-2" placeholder="Opsional">
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Absen Masuk</button>
        </form>
        <form action="{{ route('user.absen.keluar') }}" method="POST" class="bg-white border p-4 rounded shadow">
            @csrf
            <h3 class="font-semibold mb-2">Absen Keluar</h3>
            <div class="mb-3">
                <label for="keterangan_keluar" class="block text-sm font-medium">Keterangan</label>
                <input type="text" name="keterangan_keluar" id="keterangan_keluar" class="w-full border rounded px-3 py-2" placeholder="Opsional">
            </div>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Absen Keluar</button>
        </form>
    </div>
</div>
@endsection
