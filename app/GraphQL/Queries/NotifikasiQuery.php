<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\Notifikasi;
use App\Models\User;

class NotifikasiQuery extends Query
{
    protected $attributes = [
        'name' => 'Notifikasi',
        'description' => 'A query',
        'model' => Notifikasi::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Notifikasi'))));
    }

    public function args(): array
    {
        return [
            'user_id' => [
                'name' => 'user_id',
                'type' => Type::string(),
            ],

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $User = User::find($args['user_id']);
        $Notifikasi = Notifikasi::where("user_role", "MEMBER")->where("nik", $User->nik)->where("status", "not read")->get();

        return $Notifikasi;
    }
}
