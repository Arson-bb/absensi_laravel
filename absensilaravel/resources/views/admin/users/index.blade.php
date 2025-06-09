@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 p-4 overflow-x-auto">
    <div class="flex justify-between items-center mb-4">
        <!-- <h1 class="text-lg sm:text-xl md:text-2xl">Manajemen User</h1> -->
        <h2 class="text-2xl font-semibold">Manajemen User</h2>
        <a href="{{ route('admin.users.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah User</a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full border rounded border-gray-200 rounded-md overflow-x-auto">
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
                    <td class="px-4 py-2">
                        <div class="flex flex-col md:flex-row gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                            class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-center">
                            Edit
                            </a>

                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin hapus user?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 w-full md:w-auto text-center">
                                    Hapus
                                </button>
                            </form>
                        </div>
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
