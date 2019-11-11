<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EvolucionConvenio extends Model
{
    use SoftDeletes;
    
    protected $table = 'evolucion_convenios';
    protected $fillable = ['id'];

    public function convenios()
    {
        return $this->belongsTo(\App\Contrato::class, 'convenio_id')->withTrashed();
    }

    public function usuarios()
    {
        return $this->belongsTo(\App\User::class, 'user_id')->withTrashed();
    }
}
