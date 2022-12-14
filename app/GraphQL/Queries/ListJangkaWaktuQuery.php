<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\JangkaWaktu;

class ListJangkaWaktuQuery extends Query
{
    protected $attributes = [
        'name' => 'ListJangkaWaktu',
        'description' => 'A query',
        'model' => JangkaWaktu::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('ListJangkaWaktu'))));
    }

    public function args(): array
    {
        return [
            'id_instansi' => [
                'name' => 'id_instansi',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        

        return JangkaWaktu::orderByRaw('CONVERT(waktu, SIGNED) asc')->get();
    }
}
