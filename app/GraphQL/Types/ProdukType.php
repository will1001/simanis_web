<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Produk;



class ProdukType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Produk',
        'description' => 'A type',
        'model' => Produk::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Produk',
            ],
            'id_badan_usaha' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id_badan_usaha of the Produk',
            ],
            'nama' => [
                'type' => Type::string(),
                'description' => 'The nama of Produk',
            ],
            'deskripsi' => [
                'type' => Type::string(),
                'description' => 'The deskripsi of Produk',
            ],
            'foto' => [
                'type' => Type::string(),
                'description' => 'The foto of Produk',
            ],
        ];
    }
}
