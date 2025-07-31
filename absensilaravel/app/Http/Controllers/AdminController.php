<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
public function index()
    {
        $absensi = Absensi::with('user')->latest()->get();

        return view('admin.dashboard', compact('absensi'));

            $tanggal = $request->input('tanggal');

    $data = Absensi::with('user')
                ->when($tanggal, function($query, $tanggal) {
                    $query->whereDate('tanggal', $tanggal);
                })
                ->get();

    return view('admin.absensi.index', compact('data', 'tanggal'));
    }


public function export(Request $request)
{
    $tanggal = $request->input('tanggal');
    return Excel::download(new AbsensiExport($tanggal), 'absensi_' . $tanggal . '.xlsx');
}
}

