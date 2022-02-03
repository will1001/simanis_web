<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\SubCabangIndustri;



class SubCabangIndustriType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SubCabangIndustri',
        'description' => 'A type',
        'model' => SubCabangIndustri::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the SubCabangIndustri',
            ],
            'id_cabang_industri' => [
                'type' => Type::string(),
                'description' => 'The id_cabang_industri of SubCabangIndustri',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of SubCabangIndustri',
            ],
        ];
    }
}
