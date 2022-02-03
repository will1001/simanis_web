<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Kbli;



class KbliType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Kbli',
        'description' => 'A type',
        'model' => Kbli::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Kbli',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of Kbli',
            ],
        ];
    }
}
