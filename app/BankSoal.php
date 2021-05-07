<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'tingkat_id',
        'matpel_id',
        'type_soal',
        'jenis_soal',
        'soal',
        'keterangan',
        'jawaban',
        'jlm_jawaban',
        'skor_soal',
        'lable',
    ];
	public function bsJawaban(){
    	return $this->hasMany('App\Jawaban', 'bsoal_id', 'id')->orderBy('objectif', 'ASC');
    }

    public function bsSoal(){
    	return $this->hasMany('App\Soal', 'bsoal_id', 'id');
    }

    public function bsTingkat(){
    	return $this->belongsTo('App\Tingkat', 'tingkat_id', 'id');
    }

    public function bsMatpel(){
    	return $this->belongsTo('App\Matpel', 'matpel_id', 'id');
    }
}
