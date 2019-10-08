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
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
                'description' => 'email',
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
        $email = isset($args["email"])?$args["email"]:"";

        $service = new ClienteService();
        return $service->getCliente(['email' => $email], $fields);
    }
}
