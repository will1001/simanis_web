<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\DataPendukung;
use App\Models\User;
use App\Models\BadanUsaha;

class DataPendukungQuery extends Query
{
    protected $attributes = [
        'name' => 'DataPendukung',
        'description' => 'A query',
        'model' => DataPendukung::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('DataPendukung'))));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $users = User::find($args["user_id"]);
        $BadanUsaha = BadanUsaha::where('nik', $users->nik)->first();



        return DataPendukung::where('id_badan_usaha', $BadanUsaha->id)->get();
    }
}
