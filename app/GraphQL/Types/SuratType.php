<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Surat;



class SuratType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Surat',
        'description' => 'A type',
        'model' => Surat::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Surat',
            ],
            'judul_kop' => [
                'type' => Type::string(),
                'description' => 'The judul_kop of Surat',
            ],
            'alamat_kop' => [
                'type' => Type::string(),
                'description' => 'The alamat_kop of Surat',
            ],
            'nama_kadis' => [
                'type' => Type::string(),
                'description' => 'The nama_kadis of Surat',
            ],
            'nip' => [
                'type' => Type::string(),
                'description' => 'The nip of Surat',
            ],
            'jabatan' => [
                'type' => Type::string(),
                'description' => 'The jabatan of Surat',
            ],
            'alamat' => [
                'type' => Type::string(),
                'description' => 'The alamat of Surat',
            ],
            'nomor_surat' => [
                'type' => Type::string(),
                'description' => 'The nomor_surat of Surat',
            ],
            'ttd' => [
                'type' => Type::string(),
                'description' => 'The ttd of Surat',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created_at of Surat',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated_at of Surat',
            ],
        ];
    }
}
