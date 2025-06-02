@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-semibold">Manajemen User</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white    px-4 py-2 rounded hover:bg-blue-700">Tambah User</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-200 rounded-md overflow-hidden">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Role</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $user->name }}</td>
                    <td class="px-4 py-2">{{ $user->email }}</td>
                    <td class="px-4 py-2">{{ $user->role->name }}</td>
                    <td class="px-4 py-2 space-x-2">
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Yakin hapus user?')" class="text-red-600 hover:underline">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Tidak ada user.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
