<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use App\Models\User;

class AdminController extends Controller
{
public function index()
    {
        $absensi = Absensi::with('user')->latest()->get();

        return view('admin.dashboard', compact('absensi'));
    }
}

