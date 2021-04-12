<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Diccionario_variable extends Model {
	public $timestamps = false;
	protected $fillable = [
		'nombre', 'nivel',
	];

	public function variable() {
		return $this
			->belongsTo('App\Variable');
	}

	public static function categorias(int $cat) {
		$categorias = \App\Categoria::all();
		$categoria = $categorias[$cat];
		// $variables = $subcategorias->variables;
		$detalle = array();
		$total = array();

		//$detalle['categoria']=$categoria;
		$subcategorias = $categoria->subcategorias;
		foreach ($subcategorias as $subcategoria) {
			//$detalle['subcategoria']=$subcategoria;
			//dd($subcategoria);
			$variables = $subcategoria->variables;

			foreach ($variables as $variable) {
				$detalle['categoria'] = $categoria;
				$detalle['subcategoria'] = $subcategoria;
				$detalle['variable'] = $variable;
				$total[$detalle['variable']['id']] = $detalle;
			}
		}

		return ($total);
	}

}
