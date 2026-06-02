<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Post;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\Mutation;

class CreatePostsMutation extends Mutation
{
    protected $attributes = [
        'name' => 'storePost',
    ];

    public function type(): Type
    {
        return Type::nonNull(GraphQL::type('Post'));
    }

    public function args(): array
    {
        return [
            'title' => [
                'name' => 'title',
                'type' => Type::string(),
            ],
            'description' => [
                'name' => 'description',
                'type' => Type::string(),
            ],
            'author' => [
                'name' => 'author',
                'type' => Type::string(),
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $post = Post::create([
            'title' => $args['title'],
            'description' => $args['description'],
            'author' => $args['author'],
        ]);

        return $post;
    }
}
