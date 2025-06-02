@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-4">
    <h2 class="text-xl font-bold mb-4">Edit User</h2>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')
        <div>
            <label for="name" class="block font-medium">Nama</label>
            <input type="text" name="name" id="name" class="w-full border rounded px-3 py-2" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="email" class="block font-medium">Email</label>
            <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2" value="{{ $user->email }}" required>
        </div>
        <div>
            <label for="password" class="block font-medium">Password (opsional)</label>
            <input type="password" name="password" id="password" class="w-full border rounded px-3 py-2">
        </div>
        <div>
            <label for="role_id" class="block font-medium">Role</label>
            <select name="role_id" id="role_id" class="w-full border rounded px-3 py-2" required>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" class="bg-blue-600 text-black px-4 py-2 rounded hover:bg-blue-700">Update</button>
        </div>
    </form>
</div>
@endsection
