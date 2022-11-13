<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\User;
use App\Models\BadanUsaha;
use App\Models\Kabupaten;
use App\Models\CabangIndustri;

class KartuQuery extends Query
{
    protected $attributes = [
        'name' => 'Kartu',
        'description' => 'A query',
        'model' => Kartu::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Kartu'))));
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
        $BadanUsaha = BadanUsaha::where('nik', $users->nik)->get();
        $kabupaten = Kabupaten::find($BadanUsaha[0]->id_kabupaten);
        $CabangIndustri = CabangIndustri::where('name', $BadanUsaha[0]->cabang_industri)->first();
        $BadanUsaha[0]->kabupaten = $kabupaten ? $kabupaten->name : null;
        $BadanUsaha[0]->id_cabang_industri = $BadanUsaha[0]->cabang_industri;
        $BadanUsaha[0]->foto = $users->foto;
        return $BadanUsaha;
    }
}
