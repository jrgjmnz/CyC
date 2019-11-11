<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Convenio extends Model
{
    use SoftDeletes;

    protected $table = 'convenios';
    protected $fillable = ['id'];

    public function proveedores()
    {
        return $this->belongsTo(\App\Proveedor::class, 'proveedor_id')->withTrashed();
    }
    public function boletas()
    {
        return $this->belongsTo(\App\Boleta::class, 'boleta_id')->withTrashed();
    }
    public function hitos()
    {
        return $this->hasMany(\App\HitoConvenio::class);
    }
    public function prestaciones()
    {
        return $this->hasMany(\App\ConvenioPrestacion::class);
    }
}
