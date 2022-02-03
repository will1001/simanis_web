<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\SubCabangIndustri;

class SubCabangIndustriQuery extends Query
{
    protected $attributes = [
        'name' => 'SubCabangIndustri',
        'description' => 'A query',
        'model' => SubCabangIndustri::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('SubCabangIndustri'))));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'id_cabang_industri' => [
                'name' => 'id_cabang_industri',
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
            return SubCabangIndustri::where('id', $args['id'])->get();
        }

        if (isset($args['id_cabang_industri'])) {
            return SubCabangIndustri::where('id_cabang_industri', $args['id_cabang_industri'])->get();
        }

        if (isset($args['name'])) {
            return SubCabangIndustri::where('name', $args['name'])->get();
        }

        return SubCabangIndustri::all();
    }
}
