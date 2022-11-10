<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\SimulasiAngsuran;

class SimulasiAngsuranQuery extends Query
{
    protected $attributes = [
        'name' => 'SimulasiAngsuran',
        'description' => 'A query',
        'model' => SimulasiAngsuran::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('SimulasiAngsuran'))));
    }

    public function args(): array
    {
        return [
            'id_instansi' => [
                'name' => 'id_instansi',
                'type' => Type::nonNull(Type::string()),
            ],
            'id_jml_pinjaman' => [
                'name' => 'id_jml_pinjaman',
                'type' => Type::nonNull(Type::string()),
            ],
            'id_jangka_waktu' => [
                'name' => 'id_jangka_waktu',
                'type' => Type::nonNull(Type::string()),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {


        return SimulasiAngsuran::where('id_instansi', $args['id_instansi'])
            ->where('id_jml_pinjaman', $args['id_jml_pinjaman'])
            ->where('id_jangka_waktu', $args['id_jangka_waktu'])
            ->get();
    }
}
