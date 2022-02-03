<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Kecamatan;

class KecamatanQuery extends Query
{
    protected $attributes = [
        'name' => 'Kecamatan',
        'description' => 'A query',
        'model' => Kecamatan::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Kecamatan'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'id_kabupaten' => [
                'name' => 'id_kabupaten',
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
            return Kecamatan::where('id', $args['id'])->get();
        }

        if (isset($args['id_kabupaten'])) {
            return Kecamatan::where('id_kabupaten', $args['id_kabupaten'])->get();
        }

        if (isset($args['name'])) {
            return Kecamatan::where('name', $args['name'])->get();
        }

        return Kecamatan::all();
    }
}
