<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\Post;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;


class DeletePostMutation extends Mutation
{
    protected $attributes = [
        'name' => 'deletePost',
        'description' => 'Delete a post by ID',
    ];

    public function type(): Type
    {
        return Type::string(); //return Type::listOf(Type::string());
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int()), // ID must have
                // 'rules' => ['required', 'exists:posts,id'], // Laravel validation
            ],
        ];
    }

    public function resolve($root, array $args)
    {
        $post = Post::find($args['id']);

        if ($post && $post->delete()) {
            return 'Post with ID ' . $args['id'] . ' has been deleted.';
        }

        return 'Error. Post with ID ' . $args['id'] . ' not found.';
    }
}
