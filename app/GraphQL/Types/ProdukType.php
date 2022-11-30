<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Produk;



class ProdukType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Produk',
        'description' => 'A type',
        'model' => Produk::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Produk',
            ],
            'id_badan_usaha' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id_badan_usaha of the Produk',
            ],
            'nama_usaha' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The nama_usaha of the Produk',
            ],
            'nama' => [
                'type' => Type::string(),
                'description' => 'The nama of Produk',
            ],
            'harga' => [
                'type' => Type::string(),
                'description' => 'The harga of Produk',
            ],
            'deskripsi' => [
                'type' => Type::string(),
                'description' => 'The deskripsi of Produk',
            ],
            'foto' => [
                'type' => Type::string(),
                'description' => 'The foto of Produk',
            ],
            'sertifikat_halal' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_halal of Produk',
            ],
            'sertifikat_haki' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_haki of Produk',
            ],
            'sertifikat_sni' => [
                'type' => Type::string(),
                'description' => 'The sertifikat_sni of Produk',
            ],
            'nama_direktur' => [
                'type' => Type::string(),
                'description' => 'The nama_direktur of Produk',
            ],
            'no_hp' => [
                'type' => Type::string(),
                'description' => 'The no_hp of Produk',
            ],
            'alamat_lengkap' => [
                'type' => Type::string(),
                'description' => 'The alamat_lengkap of Produk',
            ],
        ];
    }
}
