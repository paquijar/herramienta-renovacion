<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$categorias = Categoria::orderBy('id', 'DESC')->paginate(3);
		return view('categoria.index', compact('categorias'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Categoria  $categoria
	 * @return \Illuminate\Http\Response
	 */
	public function show(Categoria $categoria) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Categoria  $categoria
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$categoria = categoria::find($id);
		//dd($categoria);
		return view('categoria.edit', compact('categoria'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Categoria  $categoria
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, ['nombre' => 'required', 'peso' => 'required']);
		$categorias = Categoria::where('id', '!=', $id)->get();
		$suma = 0;
		foreach ($categorias as $categoria) {
			$suma = $suma + $categoria->peso;
		}
		$suma = $suma + $request->peso;
		//dd($suma);
		if ($suma > 1) {
			//dd("1");
			return redirect()->route('categoria.index')->with('msg', 'No se actualizo, los pesos sumaban mas de 1');
		} elseif ($suma < 1) {
			//dd("2");
			categoria::find($id)->update($request->all());
			return redirect()->route('categoria.index')->with('msg', 'Se actualizo, pero los pesos suman menos de 1');
		}
		//dd("3");
		categoria::find($id)->update($request->all());
		return redirect()->route('categoria.index')->with('success', 'Registro actualizado satisfactoriamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Categoria  $categoria
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Categoria $categoria) {
		//
	}
}
