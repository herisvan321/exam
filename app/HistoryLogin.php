<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryLogin extends Model
{
	protected $fillable = [
		"peserta_id"
	];
    public function historyLoginPeserta(){
    	return $this->belongsTo('App\Peserta', 'peserta_id', 'id');
    }
}
