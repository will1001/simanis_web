<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

use App\Models\BadanUsaha;

class BadanUsahaQuery extends Query
{
    protected $attributes = [
        'name' => 'badanUsaha',
        'model' => BadanUsaha::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('BadanUsaha'))));
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
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return BadanUsaha::where('id', $args['id'])->get();
        }

        if (isset($args['nik'])) {
            return BadanUsaha::where('nik', $args['nik'])->get();
        }

        return BadanUsaha::all();
    }
}
