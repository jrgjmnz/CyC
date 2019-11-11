<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contrato extends Model
{
    use SoftDeletes;
    
    protected $table = 'contratos';
    protected $fillable = ['id'];
    
    public function proveedores()
    {
        return $this->belongsTo(\App\Proveedor::class, 'proveedor_id')->withTrashed();
    }
    public function monedas()
    {
        return $this->belongsTo(\App\Moneda::class, 'moneda_id')->withTrashed();
    }
    public function cargos()
    {
        return $this->belongsTo(\App\Cargo::class, 'cargo_id')->withTrashed();
    }
    public function boletas()
    {
        return $this->belongsTo(\App\Boleta::class, 'boleta_id')->withTrashed();
    }
    public function memos()
    {
        return $this->hasMany(\App\Memo::class);
    }
    public function hitos()
    {
        return $this->hasMany(\App\HitoContrato::class);
    }
    public function ordenCompra()
    {
        return $this->hasMany(\App\Contrato::class);
    }
    public function licitacion()
    {
        return $this->belongsTo(\App\Licitacion::class);
    }
}
