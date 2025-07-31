@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-semibold mb-4">Rekap Absensi</h1>

    <form method="GET" action="{{ route('admin.absensi.rekap') }}" class="mb-4 flex flex-wrap gap-2 items-center">
        <select name="user_id" class="border rounded px-3 py-2">
            <option value="">Semua User --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>

        <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="border rounded px-3 py-2" />

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Filter</button>
    </form>

    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm">
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
                        <td class="px-4 py-2">{{ $a->jam_keluar ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center text-gray-500">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <br>
    </div>
    <form action="{{ route('admin.absensi.export') }}" method="GET" class="mb-4 flex items-center space-x-2">
    <input type="date" name="tanggal" class="border px-2 py-1 rounded" required>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Export Excel</button>
</form>

</div>
@endsection
