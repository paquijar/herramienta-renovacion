<?php

namespace App\Http\Controllers;

use App\Hospital;
use Illuminate\Http\Request;

class HospitalsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create(Request $request) {
      	if ($request->user()->authorizeRoles('user')) {
			//dd('MAL1');
			return view('homeUser');
		}
		if ($request->user()->authorizeRoles('admin')) {
			return view('homeAdmin');
		}
        if ($request->user()->authorizeRoles('superadmin')) {
			return view('hospital.create');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		Hospital::create($request->all());
		return redirect()->route('categoria.index')->with('success', 'Registro creado satisfactoriamente');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Hospital  $hospital
	 * @return \Illuminate\Http\Response
	 */
	public function show(Hospital $hospital) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Hospital  $hospital
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Hospital $hospital) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Hospital  $hospital
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Hospital $hospital) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Hospital  $hospital
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Hospital $hospital) {
		//
	}
}
