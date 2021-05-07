<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{   
    protected $fillable = [
        'matpel_id',
        'periode_id',
        'title',
        'jlm_soal',
        'description',
        'status_ujian',
        'alokasi_waktu',
    ];

	public function ujianHistory(){
    	return $this->hasMany('App\HistoryUjain', 'ujian_id', 'id');
    }

    public function ujianSoal(){
    	return $this->hasMany('App\Soal', 'ujian_id', 'id');
    }

    public function ujianMatpel(){
    	return $this->belongsTo('App\Matpel', 'matpel_id', 'id');
    }

    public function ujianPeriode(){
    	return $this->belongsTo('App\Periode', 'periode_id', 'id');
    }

    public function ujianPaket(){
        return $this->hasMany('App\Paket', 'ujian_id', 'id');
    }
}
