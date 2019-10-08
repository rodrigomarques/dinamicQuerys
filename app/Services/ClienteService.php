<?php

namespace App\Services;
use App\Libraries\BaseRepositoryQuery;
use App\Models\Cliente;

class ClienteService
{

    public function getCliente($params = [], $fields){
        try{
            $repository = new BaseRepositoryQuery();
            $cli = new Cliente();

            return $repository->getValues($cli, $fields->getRelations(), $fields->getSelect())->get();
        }catch (\Exception $e){
            \Log::error("Lista de clientes", [ $e->getMessage() ]);
            return [];
        }
    }



}
