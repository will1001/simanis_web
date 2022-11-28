<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Produk;
use App\Models\User;
use App\Models\BadanUsaha;

class ProdukQuery extends Query
{
    protected $attributes = [
        'name' => 'Produk',
        'description' => 'A query',
        'model' => Produk::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Produk'))));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::string(),
            ],
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'id_badan_usaha' => [
                'name' => 'id_badan_usaha',
                'type' => Type::string(),
            ],
            'nama' => [
                'name' => 'nama',
                'type' => Type::string(),
            ],
            'deskripsi' => [
                'name' => 'deskripsi',
                'type' => Type::string(),
            ],
            'foto' => [
                'name' => 'foto',
                'type' => Type::string(),
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fieldBadanUsaha = [
            "produk.id as id",
            "produk.id_badan_usaha",
            "produk.nama",
            "produk.harga",
            "produk.deskripsi",
            "produk.foto",
            "produk.sertifikat_halal",
            "produk.sertifikat_haki",
            "produk.sertifikat_sni",
            "badan_usaha.nama_usaha as nama_usaha",
        ];
        if (isset($args['id'])) {
            return Produk::leftJoin('badan_usaha', 'produk.id_badan_usaha', '=', 'badan_usaha.id')
                ->where('produk.id', $args['id'])->get($fieldBadanUsaha);
        }

        if (isset($args['id_badan_usaha'])) {
            return Produk::where('id_badan_usaha', $args['id_badan_usaha'])->get();
        }
        if (isset($args['user_id'])) {
            $users = User::find($args["user_id"]);
            $BadanUsaha = BadanUsaha::where('nik', $users->nik)->first();
            return Produk::leftJoin('badan_usaha', 'produk.id_badan_usaha', '=', 'badan_usaha.id')
                ->where('id_badan_usaha', $BadanUsaha->id)->get($fieldBadanUsaha);
        }
        return Produk::leftJoin('badan_usaha', 'produk.id_badan_usaha', '=', 'badan_usaha.id')
            ->paginate(50, $fieldBadanUsaha, 'page', $args['page']);
    }
}
