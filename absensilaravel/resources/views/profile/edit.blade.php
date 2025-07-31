@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-6 px-4">
    <h2 class="text-2xl font-bold mb-4">Profil Saya</h2>

    <div class="bg-white p-4 shadow rounded space-y-2">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Role:</strong> {{ $user->role->name }}</p>
        <p><strong>Tanggal Gabung:</strong> {{ $user->created_at->format('d M Y') }}</p>
        <p><strong>Status Hari Ini:</strong> 
    {{ $user->absensis()->whereDate('tanggal', now())->exists() ? 'Sudah Absen' : 'Belum Absen' }}
</p>

    </div>
</div>

@endsection
