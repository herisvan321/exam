<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable = [
    	'title',
        'description',
        'content',
        'is_cover',
        'status_berita',
    ];
}
