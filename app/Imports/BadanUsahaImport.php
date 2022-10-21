<?php

namespace App\Imports;

use App\Models\BadanUsaha;
use Maatwebsite\Excel\Concerns\ToModel;
use Webpatser\Uuid\Uuid;

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
            'id' => Uuid::generate(),
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
            'formal_informal' => $row[10],
            'nib_tahun'     => $row[11],
            'nomor_sertifikat_halal_tahun'    => $row[12],
            'sertifikat_merek_tahun' => $row[13],
            'nomor_test_report_tahun' => $row[14],
            'sni_tahun' => $row[15],
            'jenis_usaha' => $row[16],
            'cabang_industri' => $row[17],
            'investasi_modal' => $row[18],
            'jumlah_tenaga_kerja_pria' => $row[19],
            'jumlah_tenaga_kerja_wanita' => $row[20],
            'kapasitas_produksi_perbulan' => $row[21],
            'satuan_produksi' => $row[22],
            'nilai_produksi_perbulan' => $row[23],
            'nilai_bahan_baku_perbulan' => $row[24],
        ]);
    }
}
