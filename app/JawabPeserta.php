<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JawabPeserta extends Model
{
	public $timestamps = false;
    public function jpHistoryUjian(){
    	return $this->belongsTo('App\HistoryUjian', 'hujian_id', 'id');
    }

    public function jpSoal(){
    	return $this->belongsTo('App\Soal', 'soal_id', 'id');
    }
}
