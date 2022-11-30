<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Models\BadanUsaha;
use App\Models\BadanUsahaDocuments;
use App\Models\DataPendukung;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class BadanUsahaMutation extends Mutation
{
    protected $attributes = [
        'name' => 'BadanUsaha',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('BadanUsaha'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
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
            'bentuk_usaha_file' => [
                'name' => 'bentuk_usaha_file',
                'type' => GraphQL::type('Upload'),
            ],
            'tahun_berdiri' => [
                'name' => 'tahun_berdiri',
                'type' => Type::string(),
            ],
            'nib_tahun' => [
                'name' => 'nib_tahun',
                'type' => Type::string(),
            ],
            'nib_file' => [
                'name' => 'nib_file',
                'type' => GraphQL::type('Upload'),
            ],
            'nomor_sertifikat_halal_tahun' => [
                'name' => 'nomor_sertifikat_halal_tahun',
                'type' => Type::string(),
            ],
            'sertifikat_halal_file' => [
                'name' => 'sertifikat_halal_file',
                'type' => GraphQL::type('Upload'),
            ],
            'sertifikat_merek_tahun' => [
                'name' => 'sertifikat_merek_tahun',
                'type' => Type::string(),
            ],
            'sertifikat_merek_file' => [
                'name' => 'sertifikat_merek_file',
                'type' => GraphQL::type('Upload'),
            ],
            'nomor_test_report_tahun' => [
                'name' => 'nomor_test_report_tahun',
                'type' => Type::string(),
            ],
            'sni_tahun' => [
                'name' => 'sni_tahun',
                'type' => Type::string(),
            ],
            'sertifikat_sni_file' => [
                'name' => 'sertifikat_sni_file',
                'type' => GraphQL::type('Upload'),
            ],
            'jenis_usaha' => [
                'name' => 'jenis_usaha',
                'type' => Type::string(),
            ],
            'merek_usaha' => [
                'name' => 'merek_usaha',
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
                'type' => Type::string(),
            ],
            'investasi_modal' => [
                'name' => 'investasi_modal',
                'type' => Type::string(),
            ],
            'jumlah_tenaga_kerja_pria' => [
                'name' => 'jumlah_tenaga_kerja_pria',
                'type' => Type::string(),
            ],
            'jumlah_tenaga_kerja_wanita' => [
                'name' => 'jumlah_tenaga_kerja_wanita',
                'type' => Type::string(),
            ],
            'rata_rata_pendidikan_tenaga_kerja' => [
                'name' => 'rata_rata_pendidikan_tenaga_kerja',
                'type' => Type::string(),
            ],
            'kapasitas_produksi_perbulan' => [
                'name' => 'kapasitas_produksi_perbulan',
                'type' => Type::string(),
            ],
            'satuan_produksi' => [
                'name' => 'satuan_produksi',
                'type' => Type::string(),
            ],
            'nilai_produksi_perbulan' => [
                'name' => 'nilai_produksi_perbulan',
                'type' => Type::string(),
            ],
            'nilai_bahan_baku_perbulan' => [
                'name' => 'nilai_bahan_baku_perbulan',
                'type' => Type::string(),
            ],
            'lat' => [
                'name' => 'lat',
                'type' => Type::string(),
            ],
            'lng' => [
                'name' => 'lng',
                'type' => Type::string(),
            ],
            'media_sosial' => [
                'name' => 'media_sosial',
                'type' => Type::string(),
            ],
            'foto_alat_produksi_file' => [
                'name' => 'foto_alat_produksi_file',
                'type' => GraphQL::type('Upload'),
            ],
            'foto_ruang_produksi_file' => [
                'name' => 'foto_ruang_produksi_file',
                'type' => GraphQL::type('Upload'),
            ],
            'ktp' => [
                'name' => 'ktp',
                'type' => GraphQL::type('Upload'),
            ],
            'kk' => [
                'name' => 'kk',
                'type' => GraphQL::type('Upload'),
            ],
            'ktp_pasangan' => [
                'name' => 'ktp_pasangan',
                'type' => GraphQL::type('Upload'),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        $User = User::find($args['user_id']);
        $badan_usaha = BadanUsaha::where('nik', $User->nik)->first();
        $badan_usaha_documents = BadanUsahaDocuments::where("id_badan_usaha", $badan_usaha->id);
        $data_tambahan = DataPendukung::where("id_badan_usaha", $badan_usaha->id)->first();



        if (!empty($badan_usaha_documents)) {
            $badan_usaha_documents = new BadanUsahaDocuments([
                'id' =>  Str::uuid(36),
                'id_badan_usaha' => $badan_usaha->id,
                'nib_file' => '',
                'bentuk_usaha_file' => '',
                'sertifikat_halal_file' => '',
                'sertifikat_sni_file' => '',
                'sertifikat_merek_file' => ''
            ]);
        }

        if ($args['foto_alat_produksi_file'] != null) {
            $ext = $args['foto_alat_produksi_file']->getClientOriginalExtension();
            $name1 = 'foto_alat_produksi' .  $badan_usaha->id . '.' . $ext;

            $args['foto_alat_produksi_file']->storeAs('public/foto_alat_produksi', $name1);




            // $r->merge([
            //     'foto_alat_produksi' => '/storage/foto_alat_produksi/' . $name1,
            // ]);
            $args['foto_alat_produksi'] = '/storage/foto_alat_produksi/' . $name1;
        };
        if ($args['foto_ruang_produksi_file'] != null) {

            $ext2 = $args['foto_ruang_produksi_file']->getClientOriginalExtension();
            $name2 = 'foto_ruang_produksi' .  $badan_usaha->id . '.' . $ext2;


            $args['foto_ruang_produksi_file']->storeAs('public/foto_ruang_produksi', $name2);

            // $r->merge([
            //     'foto_ruang_produksi' => '/storage/foto_ruang_produksi/' . $name2,
            // ]);
            $args['foto_ruang_produksi'] = '/storage/foto_ruang_produksi/' . $name2;
        };

        if ($args['bentuk_usaha_file'] != null) {
            $ext = $args['bentuk_usaha_file']->getClientOriginalExtension();
            $name1 = 'bentuk_usaha_file' . $badan_usaha->id . '.' . $ext;

            $args['bentuk_usaha_file']->storeAs('public/dokumen', $name1);

            $badan_usaha_documents->bentuk_usaha_file = '/storage/dokumen/' . $name1;
        };
        if ($args['nib_file'] != null) {
            $ext = $args['nib_file']->getClientOriginalExtension();
            $name1 = 'nib_file' . $badan_usaha->id . '.' . $ext;

            $args['nib_file']->storeAs('public/dokumen', $name1);

            $badan_usaha_documents->nib_file = '/storage/dokumen/' . $name1;
        };
        if ($args['sertifikat_halal_file'] != null) {
            $ext = $args['sertifikat_halal_file']->getClientOriginalExtension();
            $name1 = 'sertifikat_halal_file' . $badan_usaha->id . '.' . $ext;

            $args['sertifikat_halal_file']->storeAs('public/dokumen', $name1);

            $badan_usaha_documents->sertifikat_halal_file = '/storage/dokumen/' . $name1;
        };
        if ($args['sertifikat_merek_file'] != null) {
            $ext = $args['sertifikat_merek_file']->getClientOriginalExtension();
            $name1 = 'sertifikat_merek_file' . $badan_usaha->id . '.' . $ext;

            $args['sertifikat_merek_file']->storeAs('public/dokumen', $name1);

            $badan_usaha_documents->sertifikat_merek_file = '/storage/dokumen/' . $name1;
        };
        if ($args['sertifikat_sni_file'] != null) {
            $ext = $args['sertifikat_sni_file']->getClientOriginalExtension();
            $name1 = 'sertifikat_sni_file' . $badan_usaha->id . '.' . $ext;

            $args['sertifikat_sni_file']->storeAs('public/dokumen', $name1);

            $badan_usaha_documents->sertifikat_sni_file = '/storage/dokumen/' . $name1;
        };
        if ($args['ktp'] != null) {
            $ext = $args['ktp']->getClientOriginalExtension();
            $name1 = 'ktp' . $badan_usaha->id . '.' . $ext;

            $args['ktp']->storeAs('public/dokumen', $name1);

            $data_tambahan->ktp = '/storage/dokumen/' . $name1;
        };
        if ($args['kk'] != null) {
            $ext = $args['kk']->getClientOriginalExtension();
            $name1 = 'kk' . $badan_usaha->id  . '.' . $ext;

            $args['kk']->storeAs('public/dokumen', $name1);

            $data_tambahan->kk = '/storage/dokumen/' . $name1;
        };
        if ($args['ktp_pasangan'] != null) {
            $ext = $args['ktp_pasangan']->getClientOriginalExtension();
            $name1 = 'ktp_pasangan' . $badan_usaha->id  . '.' . $ext;

            $args['ktp_pasangan']->storeAs('public/dokumen', $name1);

            $data_tambahan->ktp_pasangan = '/storage/dokumen/' . $name1;
        };

        $data_tambahan->save();
        $badan_usaha->fill($args)->save();
        $badan_usaha_documents->save();

        return  (object)array(
            "messagges" => "success",
        );
    }
}
