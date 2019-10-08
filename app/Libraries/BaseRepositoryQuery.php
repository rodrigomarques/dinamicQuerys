<?php
namespace App\Libraries;

use Rebing\GraphQL\Support\SelectFields;

class BaseRepositoryQuery
{

    private $values = [];
    public $param;

    public function __construct()
    {
    }

    public function hasRelation($model, $relation, SelectFields $fields){
        $relations = $fields->getRelations();
        if(isset($relations[$relation])){
            $model = $model->load($relation);
        }
        return $model;
    }

    public function getAll($key, $relation, array $where = []){
        $reflection = new \ReflectionFunction($relation);
        $RValues = $reflection->getStaticVariables();

        $columnsSubQuery = ["id"];
        foreach ($RValues["select"] as $v){
            $columnsSubQuery = array_merge($columnsSubQuery, [ $v]);
        }

        $this->values[$key] = function($q) use($key, $relation, $columnsSubQuery, $where){
            $q->select($columnsSubQuery);

            if(isset($where[$key])){
                foreach ($where[$key] as $kwhere => $vwhere){
                    $q->where($kwhere, $vwhere);
                }
            }
        };

        foreach ($RValues["with"] as $kw => $w){
            $this->getAll($key.".".$kw, $w, $where);
        }

        return $this->values;
    }

    public function getValues($model, $relations, $fields, array $where = []){

        foreach ($relations as $key => $relation){
            $this->getAll($key, $relation, $where);
        }

        return $model->with($this->values)->select($fields);
    }

}