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


    $hariIni = now()->toDateString();

    $cekAbsen = Absensi::where('user_id', auth()->id())
                    ->whereDate('tanggal', $hariIni)
                    ->first();

    if ($cekAbsen && $cekAbsen->jam_masuk !== null) {
        return redirect()->back()->with('error', 'Anda sudah melakukan absen masuk hari ini.');

    }

    Absensi::create([
        'user_id' => Auth::id(),
        'jam_masuk' => now()->format('H:i:s'),
        'keterangan' => $request->keterangan_masuk,
        'tanggal' => now()->toDateString(),
    ]);


    return redirect()->back()->with('success', 'Absen masuk berhasil.');
}

public function checkOut(Request $request)
{
    $request->validate([
        'keterangan_keluar' => 'nullable|string|max:255',
    ]);

    $hariIni = now()->toDateString();

    $cekAbsen = Absensi::where('user_id', auth()->id())
                    ->whereDate('tanggal', $hariIni)
                    ->first();

    if (!$cekAbsen || $cekAbsen->jam_masuk === null) {
        return redirect()->back()->with('error', 'Anda belum melakukan absen masuk.');
    }

    if ($cekAbsen->jam_keluar !== null) {
        return redirect()->back()->with('error', 'Anda sudah melakukan absen keluar hari ini.');
    }

    $cekAbsen->update([
        'jam_keluar' => now(),
        'keterangan_keluar' => $request->keterangan_keluar,
    ]);

    return back()->with('success', 'Absen keluar berhasil.');
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
