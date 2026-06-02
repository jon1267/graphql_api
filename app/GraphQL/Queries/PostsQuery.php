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
        'name' => 'posts', // 'getPosts'
        'description' => 'Get Posts',
    ];

    public function type(): Type
    {
        return Type::nonNull(Type::listOf(Type::nonNull(GraphQL::type('Post'))));

    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::string(),
                'description' => 'Filter by title',
            ],
        ];
    }

    // public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    public function resolve($root, array $args): array|Collection|null
    {
        $query = Post::query();

        if (! empty($args['title'])) {
            $query->where('title', 'like', '%' . $args['title'] . '%');
        }
        return $query->get();
    }
}
