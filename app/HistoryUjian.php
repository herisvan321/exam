<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryUjian extends Model
{
    // public $timestamps = false;
	protected $fillable = [
		'peserta_id',
        'paket_id',
        'ujian_id',
        'ujian_ke',
        'waktu_mulai',
        'batas_waktu',
        'waktu_selesai',
        'status_ujian',
        'benar',
        'salah',
        'nilai',
	];
    public function historyUjianJawab(){
    	return $this->hasMany('App\JawabPeserta', 'hujian_id', 'id');
    }

    public function historyUjianPeserta(){
    	return $this->belongsTo('App\Peserta', 'peserta_id', 'id');
    }

    public function historyUjianU(){
    	return $this->belongsTo('App\Ujian', 'ujian_id', 'id');
    }
}
