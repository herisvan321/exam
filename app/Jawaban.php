<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
	public $timestamps = false;
    protected $fillable = [
    	'bsoal_id',
        'objectif',
        'content',
    ];

    public function jbBankSoal(){
    	return $this->hasMany('App\BankSoal', 'bsoal_id', 'id');
    }
}