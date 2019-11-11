<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConvenioPrestacion extends Model
{
    use SoftDeletes;

    protected $table = 'convenio_prestacion';
    protected $fillable = ['id'];

    public function convenios()
    {
        return $this->belongsTo(\App\Convenio::class, 'convenio_id')->withTrashed();
    }
    public function prestaciones()
    {
        return $this->belongsTo(\App\Prestacion::class, 'prestacion_id')->withTrashed();
    }
}
