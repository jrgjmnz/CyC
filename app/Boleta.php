<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Boleta extends Model
{
    use SoftDeletes;
    
    protected $table = 'boletas';
    protected $fillable = ['id'];

    public function contratos()
    {
        return $this->hasMany(\App\Contrato::class);
    }

    public function convenios()
    {
        return $this->hasMany(\App\Convenio::class);
    }
}