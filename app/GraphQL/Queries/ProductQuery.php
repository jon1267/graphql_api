<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Product;
// use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\Facades\GraphQL;

class ProductQuery extends Query
{
    protected $attributes = [
        'name' => 'product',
        'description' => 'Get Products',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Product'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],
            'name' => [
                'name' => 'name',
                'type' => Type::string(),
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
            ],
            'image' => [
                'name' => 'image',
                'type' => Type::string(),
            ],
            'price' => [
                'name' => 'price',
                'type' => Type::float(),
            ],
            'stock' => [
                'name' => 'stock',
                'type' => Type::int(),
            ],
            'category_id' => [
                'name' => 'category_id',
                'type' => Type::int(),
            ],
        ];
    }

    //public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    public function resolve($root, array $args): array|null
    {
        $query = Product::query();

        if (isset($args['id'])) {
            return $query->where('id', $args['id'])->get()->toArray();
        }

        if (isset($args['name']) || isset($args['description'])) {
            $query
                ->where('name', 'like', '%' . $args['name'] . '%')
                ->orWhere('description', 'like', '%' . $args['description'] . '%')
            ;
        }

        return $query->get()->toArray();
    }
}
