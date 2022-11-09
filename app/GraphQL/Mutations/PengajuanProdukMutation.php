<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use App\Models\JumlahPinjaman;
use App\Models\JangkaWaktu;
use App\Models\Produk;
use App\Models\BadanUsaha;
use App\Models\Notifikasi;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class PengajuanProdukMutation extends Mutation
{
    protected $attributes = [
        'name' => 'PengajuanProduk',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('PengajuanProduk'));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
            ],
            'sertifikat_halal_thn' => [
                'name' => 'sertifikat_halal_thn',
                'type' => Type::string(),
            ],
            'sertifikat_halal_no' => [
                'name' => 'sertifikat_halal_no',
                'type' => Type::string(),
            ],
            'sertifikat_haki_thn' => [
                'name' => 'sertifikat_haki_thn',
                'type' => Type::string(),
            ],
            'sertifikat_haki_no' => [
                'name' => 'sertifikat_haki_no',
                'type' => Type::string(),
            ],
            'sertifikat_sni_thn' => [
                'name' => 'sertifikat_sni_thn',
                'type' => Type::string(),
            ],
            'sertifikat_sni_no' => [
                'name' => 'sertifikat_sni_no',
                'type' => Type::string(),
            ],
            'nama' => [
                'name' => 'nama',
                'type' => Type::nonNull(Type::string()),
            ],
            'deskripsi' => [
                'name' => 'deskripsi',
                'type' => Type::nonNull(Type::string()),
            ],
            'foto' => [
                'name' => 'foto',
                'type' => Type::nonNull(GraphQL::type('Upload')),
                'rules' => ['required', 'image', 'max:1500'],
            ],
            
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $User = User::find($args['user_id']);

        $sertifikat_halal =
            (object)array(
                "tahun" => $args["sertifikat_halal_thn"],
                "nomor" => $args["sertifikat_halal_no"],
            );
        $sertifikat_haki =
            (object)array(
                "tahun" => $args["sertifikat_haki_thn"],
                "nomor" => $args["sertifikat_haki_no"],
            );
        $sertifikat_sni =
            (object)array(
                "tahun" => $args["sertifikat_sni_thn"],
                "nomor" => $args["sertifikat_sni_no"],
            );
        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();
        $cek_sertifikat_halal = str_contains(json_encode($sertifikat_halal), "null");
        $cek_sertifikat_haki = str_contains(json_encode($sertifikat_haki), "null");
        $cek_sertifikat_sni = str_contains(json_encode($sertifikat_sni), "null");



        $data = array(
            'id' => (string) Str::uuid(),
            'id_badan_usaha' => $BadanUsaha->id,
            'sertifikat_halal' => $cek_sertifikat_halal ? null : json_encode($sertifikat_halal),
            'sertifikat_haki' => $cek_sertifikat_haki ? null : json_encode($sertifikat_haki),
            'sertifikat_sni' => $cek_sertifikat_sni ? null : json_encode($sertifikat_sni),
            'nama' => $args["nama"],
            'deskripsi' => $args["deskripsi"],
        );


        if (!empty($args['foto'])) {
            $file = $args['foto'];
            $extension = $file->getClientOriginalExtension();
            $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();
            $filename = $BadanUsaha->id . '-' . time() . '.' . $extension;

            $file->move(public_path('images/'), $filename);
            $data['foto'] = '/images/' . $filename;
        }
        // dd($data);




        $produk = new Produk($data);

        // BUAT produk
        $produk->save();

        return  (object)array(
            "messagges" => "success",
        );
    }
}
