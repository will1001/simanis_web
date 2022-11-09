<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Surat;

class SuratQuery extends Query
{
    protected $attributes = [
        'name' => 'Surat',
        'description' => 'A query',
        'model' => Surat::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Surat'))));
    }

    public function args(): array
    {
        return [];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {

        return Surat::all();
    }
}
