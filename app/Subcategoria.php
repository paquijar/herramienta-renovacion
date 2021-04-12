<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model {
	public $timestamps = false;
	protected $fillable = [
		'nombre', 'peso',
	];
	public function variables() {
		return $this
			->hasMany('App\variable');
	}
	public function categoria() {
		return $this
			->belongsTo('App\Categoria');
	}
}
