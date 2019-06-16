<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

use App\Contracts\GraphQL\Types\ObjectType as ObjectTypeContract;

class Query implements ObjectTypeContract
{
    public static function getDefinition() : ObjectType
    {
        return new ObjectType([
            'name' => 'Query',
            'fields' => [
                'echo' => [
                    'type' => Type::nonNull(Type::string()),
                    'args' => [
                        'message' => Type::nonNull(Type::string())
                    ],
                    'resolve' => function($root, $args)
                    {
                        return '[You]: ' . $args['message'];
                    }
                ]
            ]
        ]);
    }
}