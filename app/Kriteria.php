<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SubKriteria;

class Kriteria extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function subkriterias()
    {
        return $this->hasMany(SubKriteria::class,'id_kriteria');
    }
}
