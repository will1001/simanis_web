<?php

namespace App\Exports;

use App\Models\BadanUsaha;
use Maatwebsite\Excel\Concerns\FromCollection;

class BadanUsahaExport implements FromCollection
{
    public function collection()
    {
        return BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->leftJoin('legalitas_usaha', 'badan_usaha.formal_informal', '=', 'legalitas_usaha.id')
            ->get([
                'badan_usaha.nik',
                'badan_usaha.nama_direktur',
                'kabupaten.name as kabupaten',
                'badan_usaha.kecamatan',
                'badan_usaha.kelurahan',
                'badan_usaha.alamat_lengkap',
                'badan_usaha.no_hp',
                'badan_usaha.nama_usaha',
                'badan_usaha.bentuk_usaha',
                'badan_usaha.tahun_berdiri',
                'badan_usaha.formal_informal',
                'badan_usaha.nib_tahun',
                'badan_usaha.nomor_sertifikat_halal_tahun',
                'badan_usaha.sertifikat_merek_tahun',
                'badan_usaha.nomor_test_report_tahun',
                'badan_usaha.sni_tahun',
                'badan_usaha.jenis_usaha',
                'badan_usaha.cabang_industri',
                'badan_usaha.investasi_modal',
                'badan_usaha.jumlah_tenaga_kerja_pria',
                'badan_usaha.jumlah_tenaga_kerja_wanita',
                'badan_usaha.kapasitas_produksi_perbulan',
                'badan_usaha.satuan_produksi',
                'badan_usaha.nilai_produksi_perbulan',
                'badan_usaha.nilai_bahan_baku_perbulan',
                'badan_usaha.created_at',
                'badan_usaha.updated_at',
            ]);
    }
}
