<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Kabupaten;



class KabupatenType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Kabupaten',
        'description' => 'A type',
        'model' => Kabupaten::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Kabupaten',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of Kabupaten',
            ],
        ];
    }
}
