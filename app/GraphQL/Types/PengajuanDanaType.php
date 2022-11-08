<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\PengajuanDana;



class PengajuanDanaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PengajuanDana',
        'description' => 'A type',
        'model' => PengajuanDana::class,
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
