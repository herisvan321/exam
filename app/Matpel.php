<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matpel extends Model
{
    protected $fillable = [
    	'kelas_id',
    	'title',
    	'status_matpel'
    ];


    public function matpelKelas(){
    	return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }

    public function matpelUjian(){
    	return $this->hasMany('App\Ujian', 'matpel_id', 'id');
    }

    public function matpelBankSoal(){
    	return $this->hasMany('App\BankSoal', 'matpel_id', 'id');
    }

    public function mMatpeUjian(){
        return $this->belongsTo('App\Ujian', 'id', 'matpel_id');
    }
}
