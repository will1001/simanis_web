<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\JumlahPinjaman;

class ListJumlahPinjamanQuery extends Query
{
    protected $attributes = [
        'name' => 'ListJumlahPinjaman',
        'description' => 'A query',
        'model' => JumlahPinjaman::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('ListJumlahPinjaman'))));
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
        

        return JumlahPinjaman::where('id_instansi', $args['id_instansi'])->orderByRaw('CONVERT(jumlah, SIGNED) asc')->get();
    }
}
