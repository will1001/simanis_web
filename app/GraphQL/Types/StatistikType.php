<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;



class StatistikType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Statistik',
        'description' => 'A type',
        'model' => Statistik::class,
    ];

    public function fields(): array
    {
        return [
            'total_ikm' => [
                'type' => Type::int(),
                'description' => 'The total_ikm of Statistik',
            ],
            'jumlah_tenaga_kerja_pria' => [
                'type' => Type::int(),
                'description' => 'The jumlah_tenaga_kerja_pria of Statistik',
            ],
            'total_tenaga_kerja_wanita' => [
                'type' => Type::int(),
                'description' => 'The total_tenaga_kerja_wanita of Statistik',
            ],
            'total_tenaga_kerja' => [
                'type' => Type::int(),
                'description' => 'The total_tenaga_kerja of Statistik',
            ],
            // 'total_industri_kecil' => [
            //     'type' => Type::int(),
            //     'description' => 'The total_industri_kecil of Statistik',
            // ],
            // 'total_industri_Menengah' => [
            //     'type' => Type::int(),
            //     'description' => 'The total_industri_Menengah of Statistik',
            // ],
        ];
    }
}
