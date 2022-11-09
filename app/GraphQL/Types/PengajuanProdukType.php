<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Produk;



class PengajuanProdukType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PengajuanProduk',
        'description' => 'A type',
        'model' => Produk::class,
    ];

    public function fields(): array
    {
        return [
            'messagges' => [
                'type' => Type::string(),
                'description' => 'messagges',
            ],
        ];
    }
}
