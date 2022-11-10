<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Instansi;

class InstansiQuery extends Query
{
    protected $attributes = [
        'name' => 'Instansi',
        'description' => 'A query',
        'model' => Instansi::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Instansi'))));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        return Instansi::all();
    }
}
