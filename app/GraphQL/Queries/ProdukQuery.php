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
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return Produk::where('id', $args['id'])->get();
        }

        if (isset($args['id_badan_usaha'])) {
            return Produk::where('id_badan_usaha', $args['id_badan_usaha'])->get();
        }
        return Produk::all();
    }
}
