<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\Survei;



class SurveiType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Survei',
        'description' => 'A type',
        'model' => Survei::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the Survei',
            ],
            'link' => [
                'type' => Type::string(),
                'description' => 'The name of Survei',
            ],
        ];
    }
}
