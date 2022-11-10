<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\JangkaWaktu;



class ListJangkaWaktuType extends GraphQLType
{
    protected $attributes = [
        'name' => 'ListJangkaWaktu',
        'description' => 'A type',
        'model' => JangkaWaktu::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of ListJangkaWaktu',
            ],
            'waktu' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The waktu of the ListJangkaWaktu',
            ],
        ];
    }
}
