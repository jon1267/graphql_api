<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use Closure;
use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class PostsQuery extends Query
{
    protected $attributes = [
        'name' => 'posts',
        'description' => 'Get Posts',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Post'));
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
            ],

            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
        ];
    }

    // public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    public function resolve($root, array $args): array|Collection|null
    {
        $query = Post::query();

        if (isset($args['id'])) {
            return $query->where('id', $args['id'])->get();
        }

        if (! empty($args['title'])) {
            $query->where('title', 'like', '%' . $args['title'] . '%');
        }

        return $query->get();
    }
}
