<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Siswa;

class RelasiTabel extends Model
{
    protected $table = 'relasi_kriteria';
    public $timestamps = false;
    protected $guarded = [];

    public function siswa(){
        return $this->belongsTo(Siswa::class,'id_siswa');
    }
}
