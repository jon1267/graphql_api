<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Post;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PostType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Post',
        'description' => 'Object type of the Post model',
        'model' => Post::class,
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'ID of the post',
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Title of the post',
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Description of the post',
            ],
            'author' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Author of the post',
            ],
        ];
    }
}
