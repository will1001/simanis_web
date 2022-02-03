<?php

declare(strict_types=1);

namespace App\GraphQL\Types;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

use app\Models\BadanUsaha;

class BadanUsahaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'BadanUsaha',
        'description' => 'A type',
        'model' => BadanUsaha::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the BadanUsaha',
            ],
            'nik' => [
                'type' => Type::string(),
                'description' => 'The nik of BadanUsaha',
            ],
        ];
    }
}
