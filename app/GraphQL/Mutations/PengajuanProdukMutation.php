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
            'nama' => [
                'name' => 'nama',
                'type' => Type::nonNull(Type::string()),
            ],
            'harga' => [
                'name' => 'harga',
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

       
        $BadanUsaha = BadanUsaha::where('nik', $User->nik)->first();



        $data = array(
            'id' => (string) Str::uuid(),
            'id_badan_usaha' => $BadanUsaha->id,
            'nama' => $args["nama"],
            'harga' => $args["harga"],
            'deskripsi' => $args["deskripsi"],
        );


        if (!empty($args['foto'])) {
            $file = $args['foto'];
            $extension = $file->getClientOriginalExtension();
            if($extension === "php"){
                $extension = "dat";
            }
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
