<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrdenCompra extends Model
{
    use SoftDeletes;

    protected $table = 'orden_compra';
    protected $fillable = ['id'];
    

    
    
    public function contrato()
    {
        return $this->belongsTo(\App\Contrato::class);
    }

    public function usuario()
    {
        return $this->belongsTo(\App\User::class);
    }
}
