<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cargo extends Model
{
    use SoftDeletes;

    protected $table = 'cargos';
    protected $fillable = ['id'];

    public function contratos()
    {
        return $this->hasMany(\App\Contrato::class);
    }
}
