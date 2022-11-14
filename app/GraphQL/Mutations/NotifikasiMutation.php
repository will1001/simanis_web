<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Notifikasi;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;


class NotifikasiMutation extends Mutation
{
    protected $attributes = [
        'name' => 'Notifikasi',
        'model' => User::class
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Notifikasi'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string()),
            ],

        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $Notifikasi = Notifikasi::find($args['id']);
        $Notifikasi->status = "read";
        $Notifikasi->save();

        return  (object)array(
            "messagges" => "success",
        );
    }
}
