<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacto extends Model
{
    use SoftDeletes;
    
    protected $table = 'contacto_proveedores';
    protected $fillable = ['id'];

    public function proveedores()
    {
        return $this->belongsTo(\App\Proveedor::class)->withTrashed();
    }
}
