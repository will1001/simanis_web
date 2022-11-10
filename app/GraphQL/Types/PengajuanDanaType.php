<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\PengajuanDana;



class PengajuanDanaType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PengajuanDana',
        'description' => 'A type',
        'model' => PengajuanDana::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::string(),
                'description' => 'id',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'created_at',
            ],
            'jumlah_dana' => [
                'type' => Type::string(),
                'description' => 'jumlah_dana',
            ],
            'waktu_pinjaman' => [
                'type' => Type::string(),
                'description' => 'waktu_pinjaman',
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'status',
            ],
            'alasan' => [
                'type' => Type::string(),
                'description' => 'alasan',
            ],
            'messagges' => [
                'type' => Type::string(),
                'description' => 'messagges',
            ],
        ];
    }
}
