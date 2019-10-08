<?php

namespace App\GraphQL\Type;

use App\Models\Cliente;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL;

class ClienteType extends GraphQLType
{

    protected $attributes = [
        'name' => 'clienteType',
        'description' => 'Dados do paciente',
        'model'         => Cliente::class,
    ];

    public function fields() : array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Id do paciente',
            ],
            'nome' => [
                'type' => Type::string(),
                'description' => 'Nome do Paciente',
            ],
            'email'  => [
                'type' => Type::string(),
                'description' => 'E-mail do Paciente',
            ],
            'endereco'  => [
                'type' => GraphQL::type('enderecoType'),
                'description' => 'Endereço',
            ],
        ];
    }

    protected function resolveEnderecoField($root, $args)
    {
        return $root->endereco;
    }

}
