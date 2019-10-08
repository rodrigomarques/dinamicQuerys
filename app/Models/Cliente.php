<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";
    protected $fillable = ["nome","email"];

    public function endereco(){
        return $this->hasOne(Endereco::class, "clienteID");
    }

}
