<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Kelurahan;



class KelurahanType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Kelurahan',
        'description' => 'A type',
        'model' => Kelurahan::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Kelurahan',
            ],
            'id_kecamatan' => [
                'type' => Type::string(),
                'description' => 'The id_kecamatan of Kelurahan',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of Kelurahan',
            ],
        ];
    }
}
