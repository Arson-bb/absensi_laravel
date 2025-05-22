@extends('layouts.app') <!-- Gunakan layout utama jika ada -->

@section('content')
<div class="container">
    <!-- <h1>Dashboard Admin</h1> -->
    <!-- <h2>Dashboard Absensi</h2> -->

    <!-- @if (session('success'))
        <div style="color: green">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div style="color: red">{{ session('error') }}</div>
    @endif

    <form action="/absen/masuk" method="POST" style="margin-bottom: 10px;">
        @csrf
        <button type="submit">Absen Masuk</button>
    </form>

    <form action="/absen/keluar" method="POST">
        @csrf
        <button type="submit">Absen Keluar</button>
    </form>

    <br>
    <a href="/absen/riwayat">Lihat Riwayat Absensi</a>
</div> -->

<div class="max-w-2xl mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Dashboard User</h1>

    <ul class="space-y-2">
        <li><a href="/user/dashboard" class="text-blue-600 hover:underline">Dashboard Absensi</a></li>
        <li><form method="POST" action="/absen/masuk">@csrf <button class="text-blue-600 hover:underline">Absen Masuk</button></form></li>
        <li><form method="POST" action="/absen/keluar">@csrf <button class="text-blue-600 hover:underline">Absen Keluar</button></form></li>
        <li><a href="/absen/riwayat" class="text-blue-600 hover:underline">Lihat Riwayat Absensi</a></li>
    </ul>
</div>
@endsection
