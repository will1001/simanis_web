<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\DataPendukung;



class DataPendukungType extends GraphQLType
{
    protected $attributes = [
        'name' => 'DataPendukung',
        'description' => 'A type',
        'model' => DataPendukung::class,
    ];

    public function fields(): array
    {
        return [

            'id' => [
                'type' => Type::string(),
                'description' => 'The id of DataPendukung',
            ],
            'id_badan_usaha' => [
                'type' => Type::string(),
                'description' => 'The id_badan_usaha of DataPendukung',
            ],
            'ktp' => [
                'type' => Type::string(),
                'description' => 'The ktp of DataPendukung',
            ],
            'kk' => [
                'type' => Type::string(),
                'description' => 'The kk of DataPendukung',
            ],
            'messagges' => [
                'type' => Type::string(),
                'description' => 'The messagges of DataPendukung',
            ],
        ];
    }
}
