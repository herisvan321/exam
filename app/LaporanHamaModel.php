<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanHamaModel extends Model
{
    public function hamaPeserta(){
    	return $this->belongsTo("App\Peserta", "peserta_id", "id");
    }
}
