<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
     public $timestamps = false;

     protected $hidden = [
     	'id',
     	'provinsi_id'
     ];

     public function kotaProvinsi(){
     	return $this->belongsTo('App\Provinsi', 'provinsi_id', 'id');
     }
}
