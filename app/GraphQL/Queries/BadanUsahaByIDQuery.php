<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\BadanUsaha;
use App\Models\User;


class BadanUsahaByIDQuery extends Query
{
    protected $attributes = [
        'name' => 'BadanUsahaByID',
        'model' => BadanUsaha::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('BadanUsahaByID'))));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
            ],

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $fieldBadanUsaha = [
            'badan_usaha.id as id',
            // 'badan_usaha_documents.id as badan_usaha_documents_id',
            'badan_usaha.nik',
            'badan_usaha.nama_direktur',
            'badan_usaha.id_kabupaten as id_kabupaten',
            'kabupaten.name as kabupaten',
            'badan_usaha.kecamatan as id_kecamatan',
            'kecamatan.name as kecamatan',
            'badan_usaha.kelurahan as id_kelurahan',
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
            'badan_usaha.merek_usaha',
            'badan_usaha.cabang_industri as id_cabang_industri',
            'cabang_industri.name as cabang_industri',
            'badan_usaha.sub_cabang_industri as id_sub_cabang_industri',
            'sub_cabang_industri.name as sub_cabang_industri',
            'badan_usaha.id_kbli as id_kbli',
            'kbli.name as kbli',
            'badan_usaha.investasi_modal',
            'badan_usaha.jumlah_tenaga_kerja_pria',
            'badan_usaha.jumlah_tenaga_kerja_wanita',
            'badan_usaha.rata_rata_pendidikan_tenaga_kerja',
            'badan_usaha.kapasitas_produksi_perbulan',
            'badan_usaha.satuan_produksi',
            'badan_usaha.nilai_produksi_perbulan',
            'badan_usaha.nilai_bahan_baku_perbulan',
            'badan_usaha_documents.nib_file',
            'badan_usaha_documents.bentuk_usaha_file',
            'badan_usaha_documents.sertifikat_halal_file',
            'badan_usaha_documents.sertifikat_sni_file',
            'badan_usaha_documents.sertifikat_merek_file',
            'badan_usaha.foto_alat_produksi',
            'badan_usaha.foto_ruang_produksi',
            'badan_usaha.media_sosial',
            'produk.foto as produk',
            'data_tambahan.ktp',
            'data_tambahan.kk',
            'data_tambahan.ktp_pasangan',

        ];

        $users = User::find($args["user_id"]);


        $badanUsaha = BadanUsaha::leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
            ->leftJoin('produk', 'badan_usaha.id', '=', 'produk.id_badan_usaha')
            ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
            ->leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
            ->where('badan_usaha.nik', $users->nik)
            ->get($fieldBadanUsaha);

        if (isset($args['offset'])) {
            $badanUsaha = $badanUsaha->limit($args['offset']);
        }

        return $badanUsaha;
    }
}
