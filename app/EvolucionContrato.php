<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvolucionContrato extends Model
{
    use SoftDeletes;
    
    protected $table = 'evolucion_contratos';
    protected $fillable = ['id'];

    public function contratos()
    {
        return $this->belongsTo(\App\Contrato::class, 'contrato_id')->withTrashed();
    }

    public function usuarios()
    {
        return $this->belongsTo(\App\User::class, 'user_id')->withTrashed();
    }
}
