<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HitoContrato extends Model
{
    protected $table = 'hito_contratos';
    protected $fillable = ['id'];

    use SoftDeletes;

    public function contratos()
    {
        return $this->belongsTo(\App\Contrato::class, 'contrato_id')->withTrashed();
    }
}