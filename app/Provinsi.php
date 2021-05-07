<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{
     public $timestamps = false;

     protected $hidden = ['id'];

     public function Kota(){
     	return $this->hasMany('App\Kota', 'provinsi_id', 'id');
     }
}
