<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    protected $fillable = [
		'title',
		'ujian_id',
		'status_paket'
	];

	public function paketSoal(){
		return $this->hasMany('App\Soal', 'paket_id', 'id');
	}

	public function paketUjian(){
		return $this->belongsTo('App\Ujian', 'ujian_id', 'id');
	}
}
