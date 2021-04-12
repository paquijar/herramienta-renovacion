<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model {
	protected $table = 'hospital';
	public $timestamps = false;
	protected $fillable = [
		'nombre', 'direccion', 'telefono', 'nivel',
	];
	public function equipos() {
		return $this
			->hasMany('App\Equipo');
	}
	public function users() {
		return $this
			->hasMany('App\User');
	}
}
