<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Proveedor extends Model
{
    use SoftDeletes;
    
    protected $table = 'proveedores';
    protected $fillable = ['id'];

    public function contratos()
    {
        return $this->hasMany(\App\Contrato::class);
    }

    public function convenios()
    {
        return $this->hasMany(\App\Convenio::class);
    }
    public function contactos()
    {
        return $this->hasMany(\App\Contacto::class);
    }
}
