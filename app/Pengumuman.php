<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $fillable = [
    	 'title',
    	 'tingkat_id',
         'content',
    ];

    public function pengumumanTingkat()
    {
    	return $this->belongsTo('App\Pengumuman', 'tingkat_id', 'id');
    }
}
