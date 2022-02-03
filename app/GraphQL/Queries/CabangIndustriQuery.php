<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\CabangIndustri;

class CabangIndustriQuery extends Query
{
    protected $attributes = [
        'name' => 'cabangIndustri',
        'description' => 'A query',
        'model' => CabangIndustri::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('CabangIndustri'))));

    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        if (isset($args['id'])) {
            return CabangIndustri::where('id', $args['id'])->get();
        }

        if (isset($args['name'])) {
            return CabangIndustri::where('name', $args['name'])->get();
        }

        return CabangIndustri::all();
    }
}
