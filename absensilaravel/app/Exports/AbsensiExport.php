<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AbsensiExport implements FromCollection, WithHeadings
{
    protected $tanggal;

    public function __construct($tanggal)
    {
        $this->tanggal = $tanggal;
    }

    public function collection()
    {
        return Absensi::with('user')
            ->whereDate('tanggal', $this->tanggal)
            ->get()
            ->map(function ($item) {
                return [
                    'Nama' => $item->user->name,
                    'Tanggal' => $item->tanggal,
                    'Masuk' => $item->jam_masuk,
                    'Keluar' => $item->jam_keluar,
                    'Keterangan Masuk' => $item->keterangan_masuk,
                    'Keterangan Keluar' => $item->keterangan_keluar,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama', 'Tanggal', 'Masuk', 'Keluar', 'Keterangan Masuk', 'Keterangan Keluar'
        ];
    }
}

