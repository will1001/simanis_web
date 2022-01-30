<?php
namespace App\Exports;

use App\Models\BadanUsaha;
use Maatwebsite\Excel\Concerns\FromCollection;

class BadanUsahaExport implements FromCollection
{
    public function collection()
    {
        return BadanUsaha::join('kabupaten', 'badan_usaha_new.id_kabupaten', '=', 'kabupaten.id')
					->get([
                        'badan_usaha_new.nik',
                        'badan_usaha_new.nama_direktur',
                        'kabupaten.name as kabupaten',
                        'badan_usaha_new.kecamatan',
                        'badan_usaha_new.kelurahan',
                        'badan_usaha_new.alamat_lengkap',
                        'badan_usaha_new.no_hp',
                        'badan_usaha_new.nama_usaha',
                        'badan_usaha_new.bentuk_usaha',
                        'badan_usaha_new.tahun_berdiri',
                        'badan_usaha_new.formal_informal',
                        'badan_usaha_new.nib_tahun',
                        'badan_usaha_new.nomor_sertifikat_halal_tahun',
                        'badan_usaha_new.sertifikat_merek_tahun',
                        'badan_usaha_new.nomor_test_report_tahun',
                        'badan_usaha_new.sni_tahun',
                        'badan_usaha_new.jenis_usaha',
                        'badan_usaha_new.cabang_industri',
                        'badan_usaha_new.investasi_modal',
                        'badan_usaha_new.jumlah_tenaga_kerja_pria',
                        'badan_usaha_new.jumlah_tenaga_kerja_wanita',
                        'badan_usaha_new.kapasitas_produksi_perbulan',
                        'badan_usaha_new.satuan_produksi',
                        'badan_usaha_new.nilai_produksi_perbulan',
                        'badan_usaha_new.nilai_bahan_baku_perbulan',
                        'badan_usaha_new.created_at',
                        'badan_usaha_new.updated_at',
                    ]);
    }
}