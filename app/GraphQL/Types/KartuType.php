<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;



class KartuType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Kartu',
        'description' => 'A type',
    ];

    public function fields(): array
    {
        return [
            'nik' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The nik of the Kartu',
            ],
            'id_cabang_industri' => [
                'type' => Type::string(),
                'description' => 'The id_cabang_industri of Kartu',
            ],
            'id_kabupaten' => [
                'type' => Type::string(),
                'description' => 'The id_kabupaten of Kartu',
            ],
            'nama_direktur' => [
                'type' => Type::string(),
                'description' => 'The nama_direktur of Kartu',
            ],
            'alamat_lengkap' => [
                'type' => Type::string(),
                'description' => 'The alamat_lengkap of Kartu',
            ],
            'nama_usaha' => [
                'type' => Type::string(),
                'description' => 'The nama_usaha of Kartu',
            ],
            'kabupaten' => [
                'type' => Type::string(),
                'description' => 'The kabupaten of Kartu',
            ],
            'foto' => [
                'type' => Type::string(),
                'description' => 'The foto of Kartu',
            ],
            'messagges' => [
                'type' => Type::string(),
                'description' => 'The messagges of Kartu',
            ],
        ];
    }
}
