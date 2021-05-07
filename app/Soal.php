<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    public $timestamps = false;
	protected $fillable = [
		'paket_id',
        'bsoal_id',
        'nourut',
	];
    public function soalJP(){
    	return $this->hasMany('App\JawabPeseta', 'soal_id', 'id');
    }

    public function soalPaket(){
    	return $this->belongsTo('App\Paket', 'paket_id', 'id');
    }

    public function soalBankSoal(){
    	return $this->belongsTo('App\BankSoal', 'bsoal_id', 'id');
    }
}
