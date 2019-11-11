<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Licitacion extends Model 
{
    use SoftDeletes;

    protected $table = 'licitaciones';
    protected $fillable = ['id'];
    

    function contratos()
    {
        return $this->hasMany(\App\Contrato::class);
    }
}