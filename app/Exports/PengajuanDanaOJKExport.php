<?php

namespace App\Exports;

use App\Models\PengajuanDana;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengajuanDanaOJKExport implements FromCollection,WithHeadings
{
    public function collection()
    {
        return PengajuanDana::leftJoin('users', 'pengajuan_dana.user_id', '=', 'users.id')
                        ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
                        ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
                        ->select(
                            'badan_usaha.nama_usaha',
                            'kabupaten.name as kabupaten',
                            'pengajuan_dana.jumlah_dana',
                            'pengajuan_dana.waktu_pinjaman',
                            'pengajuan_dana.status',
                            'pengajuan_dana.alasan',
                            )
                        ->where("instansi","BANK")
                        ->orderBy('pengajuan_dana.created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'nama_usaha',
            'kabupaten',
            'jumlah_dana.name as kabupaten',
            'waktu_pinjaman',
            'status',
            'alasan',
        ];
    }
}
