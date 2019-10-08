<?php

namespace App\Services;
use App\Libraries\BaseRepositoryQuery;
use App\Models\Cliente;

class ClienteService
{

    public function getCliente($params = [], $fields){
        try{
            $email = isset($params["email"])?$params["email"]:"";

            $repository = new BaseRepositoryQuery();
            $cli = new Cliente();

            $repo = $repository->getValues($cli, $fields->getRelations(), $fields->getSelect());
            if($email != "")
                $repo->where("email", $email);
            
            return $repo->get();
        }catch (\Exception $e){
            \Log::error("Lista de clientes", [ $e->getMessage() ]);
            return [];
        }
    }



}
