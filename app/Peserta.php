<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Peserta extends Authenticatable implements JWTSubject
{
    use Notifiable;


     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama_depan', 
        'nama_belakang', 
        'is_name', 
        'color', 
        'tingkat_id', 
        'kelas_id', 
        'tmp_lahir', 
        'tgl_lahir', 
        'nohp', 
        'provinsi_id', 
        'kota_id', 
        'post_id', 
        'alamat', 
        'photo', 
        'email', 
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }


    public function pesertaTingkat(){
    	return $this->belongsTo('App\Tingkat', 'tingkat_id', 'id');
    }

    public function pesertaKelas(){
        return $this->belongsTo('App\Kelas', 'kelas_id', 'id');
    }

    public function pesertaHistoryLogin(){
    	return $this->hasMany('App\HistoryLogin', 'peserta_id', 'id');
    }

    public function pesertaHistoryUjian(){
    	return $this->hasMany('App\HistoryUjian', 'peserta_id', 'id');
    }
}
