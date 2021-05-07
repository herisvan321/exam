<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
	protected $fillable = [
		'title',
		'status_periode'
	];
    public function periodeUjian(){
    	return $this->hasMany('App\Ujian', 'periode_id', 'id');
    }
}
