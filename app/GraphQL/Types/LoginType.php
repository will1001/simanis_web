<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\User;



class LoginType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Login',
        'description' => 'A type',
        'model' => User::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'id',
            ],
            'messagges' => [
                'type' => Type::string(),
                'description' => 'messagges',
            ],
        ];
    }
}
