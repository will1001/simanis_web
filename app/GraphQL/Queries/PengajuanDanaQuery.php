<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;
use App\Models\PengajuanDana;

class PengajuanDanaQuery extends Query
{
    protected $attributes = [
        'name' => 'PengajuanDana',
        'description' => 'A query',
        'model' => PengajuanDana::class
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('PengajuanDana'))));
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
        $PengajuanDana = PengajuanDana::leftJoin('users', 'pengajuan_dana.id_instansi', '=', 'users.id')
            ->leftJoin('instansi', 'pengajuan_dana.id_instansi', '=', 'instansi.user_id')
            ->leftJoin('badan_usaha', 'users.nik', '=', 'badan_usaha.nik')
            ->select("pengajuan_dana.id as id", "pengajuan_dana.*", "pengajuan_dana.status as status", "instansi.nama", "badan_usaha.nama_usaha as badan_usaha")
            ->where('pengajuan_dana.user_id', $args['user_id'])->orderBy('pengajuan_dana.created_at', 'desc')->get();

        return $PengajuanDana;
    }
}
