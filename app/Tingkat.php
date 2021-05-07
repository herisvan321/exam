<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tingkat extends Model
{
	protected $fillable = [
		'title',
		'status_tingkat'
	];
    public function tingkatPeserta(){
    	return $this->hasMany('App\Peserta', 'tingkat_id', 'id');
    }

    public function tingkatKelas(){
    	return $this->hasMany('App\Kelas','tingkat_id', 'id');
    }

    public function tingkatBankSoal(){
    	return $this->hasMany('App\BankSoal', 'tingkat_id', 'id');
    }

    public function tingkatPengumuman(){
        return $this->hasMany('App\Pengumuman', 'tingkat_id','id');
    }
}
