<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Notifikasi;



class NotifikasiType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Notifikasi',
        'description' => 'A type',
        'model' => Notifikasi::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Notifikasi',
            ],
            'nik' => [
                'type' => Type::string(),
                'description' => 'The nik of Notifikasi',
            ],
            'deskripsi' => [
                'type' => Type::string(),
                'description' => 'The deskripsi of Notifikasi',
            ],
            'status' => [
                'type' => Type::string(),
                'description' => 'The status of Notifikasi',
            ],
            'user_role' => [
                'type' => Type::string(),
                'description' => 'The user_role of Notifikasi',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'The created_at of Notifikasi',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'The updated_at of Notifikasi',
            ],
        ];
    }
}
