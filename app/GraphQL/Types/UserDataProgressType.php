<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\User;



class UserDataProgressType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserDataProgress',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'UserDataProgress' => [
                'type' => Type::string(),
                'description' => 'UserDataProgress',
            ],
        ];
    }
}
