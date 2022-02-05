<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

use App\Models\BadanUsaha;

class BadanUsahaQuery extends Query
{
    protected $attributes = [
        'name' => 'badanUsaha',
        'model' => BadanUsaha::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('BadanUsaha'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'nik' => [
                'name' => 'nik',
                'type' => Type::string(),
            ],
            'nama_direktur' => [
                'name' => 'nama_direktur',
                'type' => Type::string(),
            ],
            'id_kabupaten' => [
                'name' => 'id_kabupaten',
                'type' => Type::string(),
            ],
            'kecamatan' => [
                'name' => 'kecamatan',
                'type' => Type::string(),
            ],
            'kelurahan' => [
                'name' => 'kelurahan',
                'type' => Type::string(),
            ],
            'alamat_lengkap' => [
                'name' => 'alamat_lengkap',
                'type' => Type::string(),
            ],
            'no_hp' => [
                'name' => 'no_hp',
                'type' => Type::string(),
            ],
            'nama_usaha' => [
                'name' => 'nama_usaha',
                'type' => Type::string(),
            ],
            'bentuk_usaha' => [
                'name' => 'bentuk_usaha',
                'type' => Type::string(),
            ],
            'tahun_berdiri' => [
                'name' => 'tahun_berdiri',
                'type' => Type::int(),
            ],
            'formal_informal' => [
                'name' => 'formal_informal',
                'type' => Type::string(),
            ],
            'nib_tahun' => [
                'name' => 'nib_tahun',
                'type' => Type::string(),
            ],
            'nomor_sertifikat_halal_tahun' => [
                'name' => 'nomor_sertifikat_halal_tahun',
                'type' => Type::string(),
            ],
            'sertifikat_merek_tahun' => [
                'name' => 'sertifikat_merek_tahun',
                'type' => Type::string(),
            ],
            'nomor_test_report_tahun' => [
                'name' => 'nomor_test_report_tahun',
                'type' => Type::string(),
            ],
            'jenis_usaha' => [
                'name' => 'jenis_usaha',
                'type' => Type::string(),
            ],
            'cabang_industri' => [
                'name' => 'cabang_industri',
                'type' => Type::string(),
            ],
            'sub_cabang_industri' => [
                'name' => 'sub_cabang_industri',
                'type' => Type::string(),
            ],
            'id_kbli' => [
                'name' => 'id_kbli',
                'type' => Type::int(),
            ],
            'investasi_modal' => [
                'name' => 'investasi_modal',
                'type' => Type::string(),
            ],
            'jumlah_tenaga_kerja_pria' => [
                'name' => 'jumlah_tenaga_kerja_pria',
                'type' => Type::int(),
            ],
            'jumlah_tenaga_kerja_wanita' => [
                'name' => 'jumlah_tenaga_kerja_wanita',
                'type' => Type::int(),
            ],
            'kapasitas_produksi_perbulan' => [
                'name' => 'kapasitas_produksi_perbulan',
                'type' => Type::string(),
            ],
            'satuan_produksi' => [
                'name' => 'satuan_produksi',
                'type' => Type::string(),
            ],
            'nilai_bahan_baku_perbulan' => [
                'name' => 'nilai_bahan_baku_perbulan',
                'type' => Type::string(),
            ],
            'lat' => [
                'name' => 'lat',
                'type' => Type::float(),
            ],
            'lng' => [
                'name' => 'lng',
                'type' => Type::float(),
            ],
            'foto_alat_produksi' => [
                'name' => 'foto_alat_produksi',
                'type' => Type::string(),
            ],
            'foto_ruang_produksi' => [
                'name' => 'foto_ruang_produksi',
                'type' => Type::string(),
            ],
            'media_sosial' => [
                'name' => 'media_sosial',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return BadanUsaha::where('id', $args['id'])->get();
        }

        if (isset($args['nik'])) {
            return BadanUsaha::where('nik', $args['nik'])->get();
        }
      
        return BadanUsaha::all();
    }
}
