<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Propuesta extends Model {
	public $timestamps = false;
	protected $fillable = [
		'minimo', 'maximo', 'recomendacion',
	];
}
