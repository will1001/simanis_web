<?php

namespace App\Exports;

use App\Models\BadanUsaha;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BadanUsahaExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->get([
                'badan_usaha.nik',
                'badan_usaha.nama_direktur',
                'kabupaten.name as kabupaten',
                'kecamatan.name as kecamatan',
                'kelurahan.name as kelurahan',
                'badan_usaha.alamat_lengkap',
                'badan_usaha.no_hp',
                'badan_usaha.nama_usaha',
                'badan_usaha.bentuk_usaha',
                'badan_usaha.tahun_berdiri',
                'badan_usaha.nib_tahun',
                'badan_usaha.nomor_sertifikat_halal_tahun',
                'badan_usaha.sertifikat_merek_tahun',
                'badan_usaha.nomor_test_report_tahun',
                'badan_usaha.sni_tahun',
                'badan_usaha.jenis_usaha',
                'cabang_industri.name as cabang_industri',
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

    public function headings(): array
    {
        return [
            'nik',
            'nama_direktur',
            'kabupaten.name as kabupaten',
            'kecamatan',
            'kelurahan',
            'alamat_lengkap',
            'no_hp',
            'nama_usaha',
            'bentuk_usaha',
            'tahun_berdiri',
            'nib_tahun',
            'nomor_sertifikat_halal_tahun',
            'sertifikat_merek_tahun',
            'nomor_test_report_tahun',
            'sni_tahun',
            'jenis_usaha',
            'cabang_industri',
            'investasi_modal',
            'jumlah_tenaga_kerja_pria',
            'jumlah_tenaga_kerja_wanita',
            'kapasitas_produksi_perbulan',
            'satuan_produksi',
            'nilai_produksi_perbulan',
            'nilai_bahan_baku_perbulan',
            'created_at',
            'updated_at',
        ];
    }
}
