<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Kecamatan;



class KecamatanType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Kecamatan',
        'description' => 'A type',
        'model' => Kecamatan::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Kecamatan',
            ],
            'id_kabupaten' => [
                'type' => Type::string(),
                'description' => 'The id_kabupaten of Kecamatan',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of Kecamatan',
            ],
        ];
    }
}
