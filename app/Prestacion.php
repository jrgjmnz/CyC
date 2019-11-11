<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Prestacion extends Model
{
    protected $table = 'prestaciones';
    protected $fillable = ['id'];
    use SoftDeletes;

    public function convenios()
    {
        return $this->hasMany(\App\ConvenioPrestacion::class);
    }
}
