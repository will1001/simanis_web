<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\User;



class RegisterType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Register',
        'description' => 'A type',
        'model' => User::class,
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
