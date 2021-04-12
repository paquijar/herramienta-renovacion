<?php

namespace App\Http\Controllers;

use App\Diccionario_variable;
use Illuminate\Http\Request;

class Diccionario_variablesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index() {
		//
	}
	public function showOpciones($id) {
		$variable = \App\variable::find($id);
		$diccionario_variables = $variable->diccionario_variables;
		//dd($diccionario_variables);
		return view('diccionario.index', compact('diccionario_variables'));
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
	 * @param  \App\Diccionario_variable  $diccionario_variable
	 * @return \Illuminate\Http\Response
	 */
	public function show(Diccionario_variable $diccionario_variable) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Diccionario_variable  $diccionario_variable
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$diccionario_variable = diccionario_variable::find($id);
		//dd($diccionario_variable);
		return view('diccionario.edit', compact('diccionario_variable'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Diccionario_variable  $diccionario_variable
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//dd($id);
		$this->validate($request, ['nombre' => 'required', 'nivel' => 'required']);

		diccionario_variable::find($id)->update($request->all());
		return redirect()->route('variable.index')->with('success', 'Registro actualizado satisfactoriamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Diccionario_variable  $diccionario_variable
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Diccionario_variable $diccionario_variable) {
		//
	}
}
