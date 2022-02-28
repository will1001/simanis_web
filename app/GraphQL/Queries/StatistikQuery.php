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



class StatistikQuery extends Query
{
    protected $attributes = [
        'name' => 'Statistik',
        'description' => 'A query',
        'model' => Statistik::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Statistik'))));
    }

    public function args(): array
    {
        return [
            'jenis_industri' => [
                'name' => 'jenis_industri',
                'type' => Type::string(),
            ],
            'sertifikat' => [
                'name' => 'sertifikat',
                'type' => Type::string(),
            ],
            'cabang_industri' => [
                'name' => 'cabang_industri',
                'type' => Type::string(),
            ],
            'kabupaten' => [
                'name' => 'kabupaten',
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
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $badanUsaha = DB::table('badan_usaha');



        if (isset($args['cabang_industri']) && $args['cabang_industri'] != '') {
            $badanUsaha = $badanUsaha->where('cabang_industri', $args['cabang_industri']);
        }

        if (isset($args['kabupaten']) && $args['kabupaten'] != '') {
            $badanUsaha = $badanUsaha->where('id_kabupaten', $args['kabupaten']);
        }
        if (isset($args['kecamatan']) && $args['kecamatan'] != '') {
            $badanUsaha = $badanUsaha->where('kecamatan', $args['kecamatan']);
        }
        if (isset($args['kelurahan']) && $args['kelurahan'] != '') {
            $badanUsaha = $badanUsaha->where('kelurahan', $args['kelurahan']);
        }

        return $badanUsaha
            ->select(DB::raw('
            count(*) as total_ikm,
            sum(jumlah_tenaga_kerja_pria)+sum(jumlah_tenaga_kerja_wanita) as total_tenaga_kerja,
            count(case when investasi_modal <= 1000000 then 1 end) as total_industri_kecil,
            count(case when investasi_modal between 1000000+1 and 15000000-1 then 1 end) as total_industri_menengah,
            count(case when investasi_modal >= 15000000 then 1 end) as total_industri_besar,
            count(case when tahun_berdiri = YEAR(NOW()) then 1 end) as total_ikm_baru,
            count(case when nomor_sertifikat_halal_tahun IS NOT NULL then 1 end) as total_ikm_sertifikat_halal,
            count(case when sertifikat_merek_tahun IS NOT NULL then 1 end) as total_ikm_sertifikat_haki,
            count(case when sni_tahun IS NOT NULL then 1 end) as total_ikm_sertifikat_sni,
            count(case when nomor_test_report_tahun IS NOT NULL then 1 end) as total_ikm_sertifikat_test_report,
            count(case when formal_informal = "FORMAL" then 1 end) as total_ikm_formal,
            count(case when formal_informal = "INFORMAL" then 1 end) as total_ikm_informal
            '))
            ->get();
    }
}
