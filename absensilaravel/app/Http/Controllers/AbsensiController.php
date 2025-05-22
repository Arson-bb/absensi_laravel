<?php

namespace App\Http\Controllers;
use App\Models\Absensi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function checkIn()
    {
        $today = now()->toDateString();

        // Cek apakah sudah absen hari ini
        $absen = Absensi::firstOrCreate(
            ['user_id' => Auth::id(), 'tanggal' => $today],
            ['jam_masuk' => now()->toTimeString()]
        );

        return back()->with('success', 'Berhasil absen masuk!');
    }

    public function checkOut()
    {
        $today = now()->toDateString();

        $absen = Absensi::where('user_id', Auth::id())
                        ->where('tanggal', $today)
                        ->first();

        if ($absen && !$absen->jam_keluar) {
            $absen->update(['jam_keluar' => now()->toTimeString()]);
            return back()->with('success', 'Berhasil absen keluar!');
        }

        return back()->with('error', 'Sudah absen keluar atau belum absen masuk.');
    }

    public function riwayat()
    {
        $riwayat = Absensi::where('user_id', Auth::id())->latest()->get();
        return view('user.riwayat', compact('riwayat'));
    }
}
