<?php

namespace App\Imports;

use App\Models\BadanUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;

class BadanUsahaImport implements ToModel
{
    // /**
    //  * @param array $row
    //  *
    //  * @return BadanUsahaNew|null
    //  */



    public function model(array $row)
    {

        return new BadanUsaha([
            'id' => (string) Str::uuid(),
            'nik'     => $row[0],
            'nama_direktur'    => $row[1],
            'id_kabupaten' => $row[2],
            'kecamatan' => $row[3],
            'kelurahan' => $row[4],
            'alamat_lengkap' => $row[5],
            'no_hp' => $row[6],
            'nama_usaha' => $row[7],
            'bentuk_usaha' => $row[8],
            'tahun_berdiri' => $row[9],
            'nib_tahun'     => $row[10],
            'nomor_sertifikat_halal_tahun'    => $row[11],
            'sertifikat_merek_tahun' => $row[12],
            'nomor_test_report_tahun' => $row[13],
            'sni_tahun' => $row[14],
            'jenis_usaha' => $row[15],
            'cabang_industri' => $row[16],
            'investasi_modal' => $row[17],
            'jumlah_tenaga_kerja_pria' => $row[18],
            'jumlah_tenaga_kerja_wanita' => $row[19],
            'kapasitas_produksi_perbulan' => $row[20],
            'satuan_produksi' => $row[21],
            'nilai_produksi_perbulan' => $row[22],
            'nilai_bahan_baku_perbulan' => $row[23],
            'id_kbli' => $row[24],
            'omset' => $row[25],
        ]);
    }
}
