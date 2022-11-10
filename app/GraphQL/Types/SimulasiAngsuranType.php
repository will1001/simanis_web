<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\SimulasiAngsuran;



class SimulasiAngsuranType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SimulasiAngsuran',
        'description' => 'A type',
        'model' => SimulasiAngsuran::class,
    ];

    public function fields(): array
    {
        return [
            'angsuran' => [
                'type' => Type::string(),
                'description' => 'angsuran',
            ],
        ];
    }
}
