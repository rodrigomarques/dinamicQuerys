<?php

namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class EnderecoType extends GraphQLType
{
    protected $attributes = [
        'name' => 'EnderecoType',
        'description' => 'Endereço',
    ];

    public function fields() : array
    {
        return [
            'rua' => [
                'type' => Type::string(),
                'description' => 'Rua',
            ],
            'cidade' => [
                'type' => Type::string(),
                'description' => 'Cidade',
            ],

        ];
    }

}
