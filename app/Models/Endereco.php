<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $table = "endereco";
    protected $fillable = ["rua", "cidade", "clienteID" ];
}
