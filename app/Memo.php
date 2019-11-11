<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    protected $table = 'memos';
    protected $fillable = ['id'];

    public function contratos()
    {
        return $this->belongsTo(\App\Contrato::class);
    }
}
