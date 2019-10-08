<?php
/**
 * Created by PhpStorm.
 * User: 01
 * Date: 15/04/2019
 * Time: 14:37
 */

namespace App\GraphQL\Query;

use App\Libraries\FJWTAuth;
use App\Models\Especialidade;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

abstract class  BaseQuery extends Query
{

    protected $UsuarioID;
    protected $ClinicaID;
    protected $LicencaID;

    private $values = [];


    public function hasRelation($model, $relation, SelectFields $fields){
        $relations = $fields->getRelations();
        if(isset($relations[$relation])){
            $model = $model->load($relation);
        }
        return $model;
    }

    public function getAll($key, $relation){
        $reflection = new \ReflectionFunction($relation);
        $RValues = $reflection->getStaticVariables();

        $columnsSubQuery = ["id"];
        foreach ($RValues["select"] as $v){
            $columnsSubQuery = array_merge($columnsSubQuery, [ ($v)]);
        }

        $this->values[$key] = function($q) use($key, $relation, $columnsSubQuery){
            $q->select($columnsSubQuery);
        };

        foreach ($RValues["with"] as $kw => $w){
            $this->getAll($key.".".$kw, ($w));
        }

        return $this->values;
    }

    public function getValues($model, SelectFields $fields){

        foreach ($fields->getRelations() as $key => $relation){
            $this->getAll($key, $relation);
        }

        //$field = array_map('strtolower', $fields->getSelect());
        $field = $fields->getSelect();

        return $model->with($this->values)->select($field)
            ->get();
    }

}