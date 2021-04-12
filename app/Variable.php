<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Variable extends Model {
	public $timestamps = false;
	protected $fillable = [
		'nombre', 'peso',
	];
	public function equipo() {
		return $this
			->belongsToMany('App\Equipo');
	}

	public function subcategoria() {
		return $this
			->belongsTo('App\Subcategoria');
	}

	public function diccionario_variables() {
		return $this
			->hasMany('App\Diccionario_variable');
	}

	public static function peso_final() {
		$variables = \App\Variable::all();
	}
}
