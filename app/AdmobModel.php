<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdmobModel extends Model
{
	protected $fillable = [
		"id_application",
		"status_banner",
		"id_banner",
		"status_tayang",
		"id_tayang",
		"status_native",
		"id_native"
	];
}
