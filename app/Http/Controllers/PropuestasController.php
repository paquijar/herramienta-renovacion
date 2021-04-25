<?php

namespace App\Http\Controllers;

use App\Propuesta;
use Illuminate\Http\Request;

class PropuestasController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		$propuestas = Propuesta::orderBy('id', 'DESC')->get();
             if ($request->user()->authorizeRoles('user')) {
			return view('homeUser');
		}
		if ($request->user()->authorizeRoles('admin')) {
			return view('propuesta.index', compact('propuestas'));
		}
        if ($request->user()->authorizeRoles('superadmin')) {
			return view("homeSuperadmin");
		}

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
	 * @param  \App\Propuesta  $propuesta
	 * @return \Illuminate\Http\Response
	 */
	public function show(Propuesta $propuesta) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Propuesta  $propuesta
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$propuesta = Propuesta::find($id);
		//dd($categoria);
		return view('propuesta.edit', compact('propuesta'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Propuesta  $propuesta
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$this->validate($request, ['minimo' => 'required', 'maximo' => 'required', 'recomendacion' => 'required']);
		Propuesta::find($id)->update($request->all());
		return redirect()->route('propuesta.index')->with('success', 'Registro actualizado satisfactoriamente');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Propuesta  $propuesta
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Propuesta $propuesta) {
		//
	}
}
