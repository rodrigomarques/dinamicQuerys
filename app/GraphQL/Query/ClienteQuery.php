<?php
namespace App\GraphQL\Query;

use App\Services\ClienteService;
use GraphQL\Type\Definition\Type;
use GraphQL;
use Rebing\GraphQL\Support\SelectFields;
use GraphQL\Type\Definition\ResolveInfo;

class ClienteQuery extends BaseQuery
{

    protected $attributes = [
        'name' => 'clienteQuery',
        'description' => 'Lista de clientes'
    ];

    public function args() : array
    {
        return [
            'cpf' => [
                'name' => 'cpf',
                'type' => Type::string(),
                'description' => 'Cpf',
            ],
        ];
    }


    public function type() : Type
    {
        return Type::listOf(GraphQL::type('clienteType'));
    }

    /**
     * @SuppressWarnings("unused")
     */
    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, \Closure $getSelectFields)

    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        
        $cpf = isset($args["cpf"])?$args["cpf"]:"";

        $service = new ClienteService();
        return $service->getCliente(['cpf' => $cpf], $fields);
    }
}
