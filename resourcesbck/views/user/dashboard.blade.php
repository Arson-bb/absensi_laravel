@extends('layouts.app') <!-- Gunakan layout utama jika ada -->

@section('content')
<div class="container">
    <h2>Dashboard Absensi</h2>

    @if (session('success'))
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
</div>
@endsection
