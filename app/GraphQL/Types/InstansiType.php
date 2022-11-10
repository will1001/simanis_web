<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Instansi;



class InstansiType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Instansi',
        'description' => 'A type',
        'model' => Instansi::class,
    ];

    public function fields(): array
    {
        return [
            
            'id' => [
                'type' => Type::string(),
                'description' => 'The id of Instansi',
            ],
            'user_id' => [
                'type' => Type::string(),
                'description' => 'The user_id of Instansi',
            ],
            'nama' => [
                'type' => Type::string(),
                'description' => 'The nama of Instansi',
            ],
        ];
    }
}
