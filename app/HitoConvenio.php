<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HitoConvenio extends Model
{
    protected $table = 'hito_convenios';
    protected $fillable = ['id'];

    use SoftDeletes;

    public function convenios()
    {
        return $this->belongsTo(\App\Convenio::class, 'convenio_id')->withTrashed();
    }
}
