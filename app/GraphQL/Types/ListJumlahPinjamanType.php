<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\JumlahPinjaman;



class ListJumlahPinjamanType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ListJumlahPinjaman',
        'description' => 'A type',
        'model' => JumlahPinjaman::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of ListJumlahPinjaman',
            ],
            'jumlah' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The jumlah of the ListJumlahPinjaman',
            ],
        ];
    }
}
