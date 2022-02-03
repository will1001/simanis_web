<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\CabangIndustri;



class CabangIndustriType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CabangIndustri',
        'description' => 'A type',
        'model' => CabangIndustri::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the CabangIndustri',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of CabangIndustri',
            ],
        ];
    }
}
