<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

use app\Models\BadanUsaha;

class BadanUsahaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BadanUsaha',
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
            'kecamatan' => [
                'type' => Type::string(),
                'description' => 'The kecamatan of BadanUsaha',
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
            'formal_informal' => [
                'type' => Type::string(),
                'description' => 'The formal_informal of BadanUsaha',
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
            'nomor_test_report_tahun' => [
                'type' => Type::string(),
                'description' => 'The nomor_test_report_tahun of BadanUsaha',
            ],
            'jenis_usaha' => [
                'type' => Type::string(),
                'description' => 'The jenis_usaha of BadanUsaha',
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
            'investasi_modal' => [
                'type' => Type::string(),
                'description' => 'The investasi_modal of BadanUsaha',
            ],
            'jumlah_tenaga_kerja_pria' => [
                'type' => Type::int(),
                'description' => 'The jumlah_tenaga_kerja_pria of BadanUsaha',
            ],
            'jumlah_tenaga_kerja_wanita' => [
                'type' => Type::int(),
                'description' => 'The jumlah_tenaga_kerja_wanita of BadanUsaha',
            ],
            'kapasitas_produksi_perbulan' => [
                'type' => Type::string(),
                'description' => 'The kapasitas_produksi_perbulan of BadanUsaha',
            ],
            'satuan_produksi' => [
                'type' => Type::string(),
                'description' => 'The satuan_produksi of BadanUsaha',
            ],
            'nilai_bahan_baku_perbulan' => [
                'type' => Type::string(),
                'description' => 'The nilai_bahan_baku_perbulan of BadanUsaha',
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
        ];
    }
}
