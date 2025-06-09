@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-8 text-center">
    <h1 class="text-2xl font-bold mb-6">Admin Dashboard</h1>
    
    <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="{{ route('admin.absensi.rekap') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Lihat Rekap Absensi
        </a>
        <a href="{{ route('admin.users.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded hover:bg-blue-700">
            Kelola User
        </a>
    </div>
</div>

@endsection




