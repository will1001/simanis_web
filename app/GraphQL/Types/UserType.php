<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\User;



class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the User',
            ],
            'nik' => [
                'type' => Type::string(),
                'description' => 'The id_kecamatan of User',
            ],
            'isAdmin' => [
                'type' => Type::int(),
                'description' => 'The name of User',
            ],
        ];
    }
}
