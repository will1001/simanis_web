<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Kelurahan;

class KelurahanQuery extends Query
{
    protected $attributes = [
        'name' => 'Kelurahan',
        'description' => 'A query',
        'model' => Kelurahan::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Kelurahan'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'id_kecamatan' => [
                'name' => 'id_kecamatan',
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
            return Kelurahan::where('id', $args['id'])->get();
        }

        if (isset($args['id_kecamatan'])) {
            return Kelurahan::where('id_kecamatan', $args['id_kecamatan'])->get();
        }

        if (isset($args['name'])) {
            return Kelurahan::where('name', $args['name'])->get();
        }

        return Kelurahan::all();
    }
}
