<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Product;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ProductType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Product',
        'description' => 'Object type of the Product model',
        'model' => Product::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the product',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Name of the product',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of the product',
            ],
            'image' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Image of the product',
            ],
            'price' => [
                'type' => Type::nonNull(Type::float()),
                'description' => 'Price of the product',
            ],
            'stock' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Stock of the product',
            ],
            'category_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Category ID of the product',
            ],
        ];
    }
}
