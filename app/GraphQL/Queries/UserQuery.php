<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A query',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('User'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'nik' => [
                'name' => 'nik',
                'type' => Type::string(),
            ],
            'isAdmin' => [
                'name' => 'isAdmin',
                'type' => Type::int(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return User::where('id', $args['id'])->get();
        }

        if (isset($args['nik'])) {
            return User::where('nik', $args['nik'])->get();
        }

        if (isset($args['isAdmin'])) {
            return User::where('isAdmin', $args['isAdmin'])->get();
        }

        return User::all();
    }
}
