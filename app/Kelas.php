<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $fillable = [
        'tingkat_id',
        'title',
        'status_kelas',
        'jenis_kelas'
    ];
    public function kelasPeserta(){
    	return $this->hasMany('App\Peserta', 'kelas_id', 'id');
    }

    public function kelasMatpel(){
    	return $this->hasMany('App\Matpel', 'kelas_id', 'id');
    }

    public function kelasBankSoal(){
    	return $this->hasMany('App\BankSoal', 'peserta_id', 'id');
    }

    public function kelasTingkat(){
    	return $this->belongsTo('App\Tingkat', 'tingkat_id', 'id');
    }
}
