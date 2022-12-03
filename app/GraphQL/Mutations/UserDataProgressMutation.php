<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\UserDataProgress;
use App\Models\BadanUsaha;
use App\Models\Notifikasi;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class UserDataProgressMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UserDataProgress',
        'model' => UserDataProgress::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('UserDataProgress'));
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

        $userDataProgress = array();
        $users = User::find($args["user_id"]);

        $fieldBadanUsaha = [
            'badan_usaha.id as id',
            'badan_usaha_documents.id as badan_usaha_documents_id',
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
            'badan_usaha.merek_usaha',
            'cabang_industri.name as cabang_industri',
            'sub_cabang_industri.name as sub_cabang_industri',
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
            'data_tambahan.ktp',
            'data_tambahan.kk',
            'data_tambahan.ktp_pasangan',

        ];

        $fields = [
            // 'id',
            'nik',
            'nama_direktur',
            'kabupaten',
            'kecamatan',
            'kelurahan',
            'alamat_lengkap',
            'no_hp',
            'nama_usaha',
            'bentuk_usaha',
            'bentuk_usaha_file',
            'tahun_berdiri',
            'nib_tahun',
            'nib_file',
            'nomor_sertifikat_halal_tahun',
            'sertifikat_halal_file',
            'sertifikat_merek_tahun',
            'sertifikat_merek_file',
            'nomor_test_report_tahun',
            'sni_tahun',
            'sertifikat_sni_file',
            'jenis_usaha',
            'merek_usaha',
            'cabang_industri',
            'sub_cabang_industri',
            'kbli',
            'investasi_modal',
            'jumlah_tenaga_kerja_pria',
            'jumlah_tenaga_kerja_wanita',
            'rata_rata_pendidikan_tenaga_kerja',
            'kapasitas_produksi_perbulan',
            'satuan_produksi',
            'nilai_produksi_perbulan',
            'nilai_bahan_baku_perbulan',
            'lat',
            'lng',
            'media_sosial',
            'foto_alat_produksi',
            'foto_ruang_produksi',
            'ktp',
            'kk',
            'ktp_pasangan',
            // 'created_at',
            // 'updated_at'
        ];


        $badan_usaha = BadanUsaha::leftJoin('badan_usaha_documents', 'badan_usaha.id', '=', 'badan_usaha_documents.id_badan_usaha')
            ->leftJoin('kabupaten', 'badan_usaha.id_kabupaten', '=', 'kabupaten.id')
            ->leftJoin('kecamatan', 'badan_usaha.kecamatan', '=', 'kecamatan.id')
            ->leftJoin('kelurahan', 'badan_usaha.kelurahan', '=', 'kelurahan.id')
            ->leftJoin('cabang_industri', 'badan_usaha.cabang_industri', '=', 'cabang_industri.id')
            ->leftJoin('sub_cabang_industri', 'badan_usaha.sub_cabang_industri', '=', 'sub_cabang_industri.id')
            ->leftJoin('kbli', 'badan_usaha.id_kbli', '=', 'kbli.id')
            ->leftJoin('data_tambahan', 'badan_usaha.id', '=', 'data_tambahan.id_badan_usaha')
            ->where("nik", $users->nik)
            ->get($fieldBadanUsaha);


        foreach ($badan_usaha as $key => &$item) {
            $userDataProgress[$key] = 0;
            $totalnull = 0;
            foreach ($fields as &$field) {

                if (!isset($item->{$field})) {
                    $totalnull += 1;
                }
            }
            $userDataProgress[$key] = ((count($fields) - ($totalnull - 9)) / (count($fields))) * 100;
        }

        return  (object)array(
            "UserDataProgress" => $userDataProgress[0],
        );
    }
}
