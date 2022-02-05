<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use app\Models\SlideShow;



class SlideShowType extends GraphQLType
{
    protected $attributes = [
        'name' => 'SlideShow',
        'description' => 'A type',
        'model' => SlideShow::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of the SlideShow',
            ],
            'img' => [
                'type' => Type::string(),
                'description' => 'The name of SlideShow',
            ],
        ];
    }
}
