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
            'total_tenaga_kerja' => [
                'type' => Type::int(),
                'description' => 'The total_tenaga_kerja of Statistik',
            ],
            'total_industri_kecil' => [
                'type' => Type::int(),
                'description' => 'The total_industri_kecil of Statistik',
            ],
            'total_industri_menengah' => [
                'type' => Type::int(),
                'description' => 'The total_industri_menengah of Statistik',
            ],
            'total_industri_besar' => [
                'type' => Type::int(),
                'description' => 'The total_industri_besar of Statistik',
            ],
            'total_ikm_baru' => [
                'type' => Type::int(),
                'description' => 'The total_ikm_baru of Statistik',
            ],
            'total_ikm_sertifikat_halal' => [
                'type' => Type::int(),
                'description' => 'The total_ikm_sertifikat_halal of Statistik',
            ],
            'total_ikm_sertifikat_haki' => [
                'type' => Type::int(),
                'description' => 'The total_ikm_sertifikat_haki of Statistik',
            ],
            'total_ikm_sertifikat_sni' => [
                'type' => Type::int(),
                'description' => 'The total_ikm_sertifikat_sni of Statistik',
            ],
        ];
    }
}
