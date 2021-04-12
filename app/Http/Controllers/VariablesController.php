<?php

namespace App\Http\Controllers;

use App\Variable;
use Illuminate\Http\Request;

class VariablesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	public function index() {
		$variables = variable::orderBy('id', 'DESC')->get();
		return view('variable.index', compact('variables'));
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
	 * @param  \App\Variable  $variable
	 * @return \Illuminate\Http\Response
	 */
	public function show(Variable $variable) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Variable  $variable
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$variable = variable::find($id);
		//dd($categoria);
		return view('variable.edit', compact('variable'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Variable  $variable
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, ['peso' => 'required']);
		$sub = variable::find($id)->subcategoria_id;
		//dd($sub);
		$variables = Variable::where('id', '!=', $id)->where('subcategoria_id', $sub)->get();
		$suma = 0;
		foreach ($variables as $variable) {
			$suma = $suma + $variable->peso;
		}
		$suma = $suma + $request->peso;
		//dd($suma);
		if ($suma > 1) {
			//dd("1");
			return redirect()->route('variable.index')->with('msg', 'No se actualizo, los pesos sumaban mas de 1');
		} elseif ($suma < 1) {
			//dd("2");
			variable::find($id)->update($request->all());
			return redirect()->route('variable.index')->with('msg', 'Se actualizo, pero los pesos suman menos de 1');
		}
		//dd("3");

		variable::find($id)->update($request->all());
		return redirect()->route('variable.index')->with('success', 'Registro actualizado satisfactoriamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Variable  $variable
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Variable $variable) {
		//
	}
}
