<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class AbsensiController extends Controller
{


public function checkIn(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login')->with('error', 'Silakan login terlebih dahulu.');
    }

    $request->validate([
        'keterangan_masuk' => 'nullable|string|max:255',
    ]);

    // dd(Auth::id(), \App\Models\User::find(Auth::id()));

    $existing = Absensi::where('user_id', Auth::id())
    ->where('tanggal', now()->toDateString())
    ->first();

    if ($existing) {
        return redirect()->back()->with('error', 'Anda sudah absen masuk hari ini.');
    }

    Absensi::create([
        'user_id' => Auth::id(),
        'jam_masuk' => now()->format('H:i:s'),
        'keterangan' => $request->keterangan_masuk,
        'tanggal' => now()->toDateString(),
    ]);

    // $todayAbsen = Absensi::where('user_id', Auth::id())
    //     ->whereDate('tanggal', now()->toDateString())
    //     ->first();

    // if ($todayAbsen && !$todayAbsen->jam_keluar) {
    //     return redirect()->back()->with('error', 'Anda belum melakukan absen keluar hari ini.');
    // }

    
    return redirect()->back()->with('success', 'Absen masuk berhasil.');
}

public function checkOut(Request $request)
{
    $request->validate([
        'keterangan_keluar' => 'nullable|string|max:255',
    ]);

    $absen = Absensi::where('user_id', Auth::id())
        ->where('tanggal', now()->toDateString()) 
        ->latest()
        ->first();

    if ($absen && !$absen->jam_keluar) {
        $absen->update([
            'jam_keluar' => now()->format('H:i:s'),
            'keterangan' => $absen->keterangan . ' | ' . $request->keterangan_keluar,
        ]);

        return redirect()->back()->with('success', 'Absen keluar berhasil.');
    }

    return redirect()->back()->with('success', 'Tidak ditemukan absen masuk hari ini atau sudah absen keluar.');
}

public function rekap(Request $request)
{
    $users = User::all();

    $query = Absensi::with('user')->orderBy('tanggal', 'desc');

    if ($request->filled('user_id')) {
        $query->where('user_id', $request->user_id);
    }

    if ($request->filled('tanggal')) {
        $query->where('tanggal', $request->tanggal);
    }

    $absensi = $query->get();

    return view('admin.absensi.index', compact('absensi', 'users'));
}

    public function riwayat()
    {
        $riwayat = Absensi::where('user_id', Auth::id())->latest()->get();
        return view('user.riwayat', compact('riwayat'));
    }
}
