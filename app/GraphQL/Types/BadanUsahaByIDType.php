<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

use app\Models\BadanUsaha;

class BadanUsahaByIDType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BadanUsahaByID',
        'description' => 'A type',
        'model' => BadanUsaha::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the BadanUsaha',
            ],
            'nik' => [
                'type' => Type::string(),
                'description' => 'The nik of BadanUsaha',
            ],
            'nama_direktur' => [
                'type' => Type::string(),
                'description' => 'The nama_direktur of BadanUsaha',
            ],
            'id_kabupaten' => [
                'type' => Type::string(),
                'description' => 'The id_kabupaten of BadanUsaha',
            ],
            'kabupaten' => [
                'type' => Type::string(),
                'description' => 'The kabupaten of BadanUsaha',
            ],
            'id_kecamatan' => [
                'type' => Type::string(),
                'description' => 'The id_kecamatan of BadanUsaha',
            ],
            'kecamatan' => [
                'type' => Type::string(),
                'description' => 'The kecamatan of BadanUsaha',
            ],
            'id_kelurahan' => [
                'type' => Type::string(),
                'description' => 'The id_kelurahan of BadanUsaha',
            ],
            'kelurahan' => [
                'type' => Type::string(),
                'description' => 'The kelurahan of BadanUsaha',
            ],
            'alamat_lengkap' => [
                'type' => Type::string(),
                'description' => 'The alamat_lengkap of BadanUsaha',
            ],
            'no_hp' => [
                'type' => Type::string(),
                'description' => 'The no_hp of BadanUsaha',
            ],
            'nama_usaha' => [
                'type' => Type::string(),
                'description' => 'The nama_usaha of BadanUsaha',
            ],
            'bentuk_usaha' => [
                'type' => Type::string(),
                'description' => 'The bentuk_usaha of BadanUsaha',
            ],
            'tahun_berdiri' => [
                'type' => Type::int(),
                'description' => 'The tahun_berdiri of BadanUsaha',
            ],
           
            'nib_tahun' => [
                'type' => Type::string(),
                'description' => 'The nib_tahun of BadanUsaha',
            ],
            'nomor_sertifikat_halal_tahun' => [
                'type' => Type::string(),
                'description' => 'The nomor_sertifikat_halal_tahun of BadanUsaha',
            ],
            'sertifikat_merek_tahun' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_merek_tahun of BadanUsaha',
            ],
            'sni_tahun' => [
                'type' => Type::string(),
                'description' => 'The sni_tahun of BadanUsaha',
            ],
            'nomor_test_report_tahun' => [
                'type' => Type::string(),
                'description' => 'The nomor_test_report_tahun of BadanUsaha',
            ],
            'jenis_usaha' => [
                'type' => Type::string(),
                'description' => 'The jenis_usaha of BadanUsaha',
            ],
            'merek_usaha' => [
                'type' => Type::string(),
                'description' => 'The merek_usaha of BadanUsaha',
            ],
            'cabang_industri' => [
                'type' => Type::string(),
                'description' => 'The cabang_industri of BadanUsaha',
            ],
            'sub_cabang_industri' => [
                'type' => Type::string(),
                'description' => 'The sub_cabang_industri of BadanUsaha',
            ],
            'id_kbli' => [
                'type' => Type::int(),
                'description' => 'The id_kbli of BadanUsaha',
            ],
            'id_cabang_industri' => [
                'type' => Type::string(),
                'description' => 'The id_cabang_industri of BadanUsaha',
            ],
            'id_sub_cabang_industri' => [
                'type' => Type::string(),
                'description' => 'The id_sub_cabang_industri of BadanUsaha',
            ],
            'kbli' => [
                'type' => Type::string(),
                'description' => 'The kbli of BadanUsaha',
            ],
            'investasi_modal' => [
                'type' => Type::string(),
                'description' => 'The investasi_modal of BadanUsaha',
            ],
            'jumlah_tenaga_kerja_pria' => [
                'type' => Type::string(),
                'description' => 'The jumlah_tenaga_kerja_pria of BadanUsaha',
            ],
            'jumlah_tenaga_kerja_wanita' => [
                'type' => Type::string(),
                'description' => 'The jumlah_tenaga_kerja_wanita of BadanUsaha',
            ],
            'rata_rata_pendidikan_tenaga_kerja' => [
                'type' => Type::string(),
                'description' => 'The rata_rata_pendidikan_tenaga_kerja of BadanUsaha',
            ],
            'kapasitas_produksi_perbulan' => [
                'type' => Type::string(),
                'description' => 'The kapasitas_produksi_perbulan of BadanUsaha',
            ],
            'satuan_produksi' => [
                'type' => Type::string(),
                'description' => 'The satuan_produksi of BadanUsaha',
            ],
            'nilai_produksi_perbulan' => [
                'type' => Type::string(),
                'description' => 'The nilai_produksi_perbulan of BadanUsaha',
            ],
            'nilai_bahan_baku_perbulan' => [
                'type' => Type::string(),
                'description' => 'The nilai_bahan_baku_perbulan of BadanUsaha',
            ],
            'nib_file' => [
                'type' => Type::string(),
                'description' => 'The nib_file of BadanUsaha',
            ],
            'bentuk_usaha_file' => [
                'type' => Type::string(),
                'description' => 'The bentuk_usaha_file of BadanUsaha',
            ],
            'sertifikat_halal_file' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_halal_file of BadanUsaha',
            ],
            'sertifikat_sni_file' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_sni_file of BadanUsaha',
            ],
            'sertifikat_merek_file' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_merek_file of BadanUsaha',
            ],
            'lat' => [
                'type' => Type::float(),
                'description' => 'The lat of BadanUsaha',
            ],
            'lng' => [
                'type' => Type::float(),
                'description' => 'The lng of BadanUsaha',
            ],
            'foto_alat_produksi' => [
                'type' => Type::string(),
                'description' => 'The foto_alat_produksi of BadanUsaha',
            ],
            'foto_ruang_produksi' => [
                'type' => Type::string(),
                'description' => 'The foto_ruang_produksi of BadanUsaha',
            ],
            'media_sosial' => [
                'type' => Type::string(),
                'description' => 'The media_sosial of BadanUsaha',
            ],
            'produk' => [
                'type' => Type::string(),
                'description' => 'The produk of BadanUsaha',
            ],
            'ktp' => [
                'type' => Type::string(),
                'description' => 'The ktp of BadanUsaha',
            ],
            'kk' => [
                'type' => Type::string(),
                'description' => 'The kk of BadanUsaha',
            ],
            'ktp_pasangan' => [
                'type' => Type::string(),
                'description' => 'The ktp_pasangan of BadanUsaha',
            ],
            'messagges' => [
                'type' => Type::string(),
                'description' => 'The messagges of BadanUsaha',
            ],
            'omset' => [
                'type' => Type::string(),
                'description' => 'The omset of BadanUsaha',
            ],
        ];
    }
}
