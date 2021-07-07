<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kriteria;

class SubKriteria extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function kriteria(){
        return $this->belongsTo(Kriteria::class,'id_kriteria');
    }
}
