<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\RelasiTabel;

class Siswa extends Model
{
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['tanggal_lahir'];

    public function relasis()
    {
        return $this->hasMany(RelasiTabel::class,'id_siswa');
    }
}
