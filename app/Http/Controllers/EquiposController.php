<?php

namespace App\Http\Controllers;
use App\Equipo;
use Illuminate\Http\Request;

class EquiposController extends Controller {
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
	public function create() {
		return view('criterios/info');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$form = request()->all();
		//dd($form);
		//dd(auth()->user()->hospital->id);
		$this->validate(request(), [

			'nombre' => 'required',
			'edad' => 'required',
			'vida_util' => 'required',
			'costo_adquisicion' => 'required',
			'costo_nuevo' => 'required',
			'costo_mantenimiento' => 'required',
			'tiempo_parado' => 'required',
			'tiempo_operacion' => 'required',
			'nro_reparaciones' => 'required',
			'años_reparaciones' => 'required',

		]);
		//dd($request);
		//$form = request()->all();
		//dd($form);
		$equipo = new Equipo($form);
		$equipo->hospital_id = auth()->user()->hospital->id;
		//dd($equipo);
		$equipo->save();
		//dd($equipo->id);
		$request->session()->flash('alert-success', 'Equipo Guardado');
		return redirect('/showEquipos');
	}
	public function showEquipo($id) {
		$equipo = Equipo::find($id);

		$propuestas = \App\Propuesta::all();
		$propuestaFinal = "";
		foreach ($propuestas as $propuesta) {
			// dd($propuesta->minimo);
			// dd($equipo->score);
			if ($propuesta->minimo < $equipo->score && $propuesta->maximo > $equipo->score) {
				//dd('aaa');
				$equipo->recomendacion = $propuesta->recomendacion;
				//dd($equipo);
			}
		}
		return view('equipo.show', compact('equipo'));
		##dd($equipos);
	}

	public function showEquipos(Equipo $equipo) {

		$hospital = auth()->user()->hospital;

		$equipos = $hospital->equipos;

		return view('criterios/creados')->with('equipos', $equipos);

	}

	public function showSin(Equipo $equipo) {
		$hospital = auth()->user()->hospital;
		$equipos = $hospital->equipos;
		##dd($equipos);
		return view('criterios/sinCalcular')->with('equipos', $equipos);

	}

	public function createTecnicos(Equipo $equipo) {
		//dd($equipo);
		$variables = \App\Diccionario_variable::categorias(0);
		//dd($variables);
		//$variables['equipo'] = $equipo->id;
		unset($variables[3]);
		unset($variables[4]);
		unset($variables[6]);
		//dd($variables);
		$opciones = array();

		//dd($equipoVar[0]->pivot->valor);
		foreach ($variables as $variable) {
			//dd($variables);
			$opc = $variable['variable']->diccionario_variables;
			$opc->variable = $variable['variable']['nombre'];
			array_push($opciones, $opc);
		}
		// $x = $variables[14]['variable'];
		// $y = $x->diccionario_variables;
		// dd($y);
		$equipoVar = 0;
		array_push($opciones, $equipo);
		if ($equipo->tecnicos) {
			$equipoVar = $equipo->variable;
			//dd($equipoVar);
			$x = 0;
			foreach ($equipoVar as $variable) {
				//dd($variable->subcategoria_id);
				if (!in_array($variable->subcategoria_id, [1, 2, 3])) {
					unset($equipoVar[$x]);
				}
				$x = $x + 1;
			}
			unset($equipoVar[0]);
			unset($equipoVar[1]);
			unset($equipoVar[2]);
			$x = 0;
			foreach ($equipoVar as $variable) {
				$equipoVar[$x] = $variable;
				$x = $x + 1;
			}
			$temp = $equipoVar[0];
			$equipoVar[0] = $equipoVar[1];
			$equipoVar[1] = $temp;

			$temp = $equipoVar[1];
			$equipoVar[1] = $equipoVar[2];
			$equipoVar[2] = $temp;

			$temp = $equipoVar[2];
			$equipoVar[2] = $equipoVar[4];
			$equipoVar[4] = $temp;

			$temp = $equipoVar[3];
			$equipoVar[3] = $equipoVar[4];
			$equipoVar[4] = $temp;

		}
		array_push($opciones, $equipoVar);
		//dd($opciones);
		//array_pop($opciones);

		return view('criterios/tecnicos')->with('opciones', $opciones);
	}

	public function createClinicos(Equipo $equipo) {
		//dd($equipo);
		$variables = \App\Diccionario_variable::categorias(1);
		//dd($variables);
		//$variables['equipo'] = $equipo->id;
		$opciones = array();

		//dd($equipoVar[0]->pivot->valor);
		foreach ($variables as $variable) {
			//dd($variables);
			$opc = $variable['variable']->diccionario_variables;
			$opc->variable = $variable['variable']['nombre'];
			array_push($opciones, $opc);
		}

		//dd($opciones);
		$equipoVar = 0;
		array_push($opciones, $equipo);
		if ($equipo->clinicos) {
			$equipoVar = $equipo->variable;
			//dd($equipoVar);
			$x = 0;
			foreach ($equipoVar as $variable) {
				//dd($variable->subcategoria_id);
				if (!in_array($variable->subcategoria_id, [4, 5])) {
					unset($equipoVar[$x]);
				}
				$x = $x + 1;
			}
			//$keys = array_keys($equipoVar);
			$x = 0;
			foreach ($equipoVar as $variable) {
				$equipoVar[$x] = $variable;
				$x = $x + 1;
			}
			$temp = $equipoVar[0];
			$equipoVar[0] = $equipoVar[1];
			$equipoVar[1] = $temp;
			$temp = $equipoVar[1];
			$equipoVar[1] = $equipoVar[2];
			$equipoVar[2] = $temp;
			//dd($equipoVar[0]->pivot->valor);

		}
		array_push($opciones, $equipoVar);
		//dd($opciones);
		//array_pop($opciones);
		return view('criterios/clinicos')->with('opciones', $opciones);
	}

	public function storeTecnicos(Request $request) {
		$form = request()->all();
		//dd($form);
		//dd(auth()->user()->hospital->id);
		// $this->validate(request(), [

		// 	'estado_de_tecnologia' => 'required', #
		// 	'Soporte_Tecnico_(años_restantes)' => 'required', #
		// 	'suministro_de_repuestos' => 'required', #
		// 	'mediciones' => 'required', #
		// 	'mantenimientos_preventivos_(anual)' => 'required', #

		// ]);
		///////////hasta aca
		//dd($request);
		//$form = request()->all();
		//dd($form);

		$equipo = Equipo::find($form['equipo']);
		$vida = $equipo['edad'] / $equipo['vida_util'];
		$eficiencia = ($equipo['tiempo_operacion'] - $equipo['tiempo_parado']) * 100 / $equipo['tiempo_operacion'];
		$tasa_falla = $equipo['nro_reparaciones'] / $equipo['años_reparaciones'];
		//dd($vida);
		if ($vida == 0) {
			$vida = 0;
		} elseif ($vida > 0 && $vida < 0.6) {
			$vida = 1;
		} elseif ($vida >= 0.6 && $vida < 1) {
			$vida = 2;
		} elseif ($vida == 1) {
			$vida = 3;
		} else {
			$vida = 4;
		}

		if ($eficiencia >= 90) {
			$eficiencia = 1;
		} elseif ($eficiencia >= 70 && $eficiencia < 90) {
			$eficiencia = 2;
		} elseif ($eficiencia >= 50 && $eficiencia < 70) {
			$eficiencia = 3;
		} else {
			$eficiencia = 4;
		}
		//dd($tasa_falla);
		if ($tasa_falla == 0) {
			$tasa_falla = 0;
		} elseif ($tasa_falla > 0 && $tasa_falla <= 1) {
			$tasa_falla = 1;
		} elseif ($tasa_falla > 1 && $tasa_falla <= 1.5) {
			$tasa_falla = 2;
		} elseif ($tasa_falla > 1.5 && $tasa_falla <= 2) {
			$tasa_falla = 3;
		} else {
			$tasa_falla = 4;
		}
		//dd($tasa_falla);
		if (!$equipo->tecnicos) {
			$equipo->variable()->attach([
				14 => ['valor' => $form['Estado_de_Tecnología']],
				21 => ['valor' => $form['Soporte_Técnico_(Años_Restantes)']],
				15 => ['valor' => $form['Suministro_de_Repuestos']],
				3 => ['valor' => $vida],
				4 => ['valor' => $eficiencia],
				6 => ['valor' => $tasa_falla],
				17 => ['valor' => $form['Mediciones']],
				8 => ['valor' => $form['Mantenimientos_Preventivos_(Anual)']],
			]
			);
		} else {
			$equipo->variable()->updateExistingPivot(14, ['valor' => $form['Estado_de_Tecnología']]);
			$equipo->variable()->updateExistingPivot(21, ['valor' => $form['Soporte_Técnico_(Años_Restantes)']]);
			$equipo->variable()->updateExistingPivot(15, ['valor' => $form['Suministro_de_Repuestos']]);
			$equipo->variable()->updateExistingPivot(3, ['valor' => $vida]);
			$equipo->variable()->updateExistingPivot(4, ['valor' => $eficiencia]);
			$equipo->variable()->updateExistingPivot(6, ['valor' => $tasa_falla]);
			$equipo->variable()->updateExistingPivot(17, ['valor' => $form['Mediciones']]);
			$equipo->variable()->updateExistingPivot(8, ['valor' => $form['Mantenimientos_Preventivos_(Anual)']]);

		}
		$equipo->tecnicos = 1;

		$equipo->save();
		return redirect('/showEquipos');
	}

	public function storeClinicos(Request $request) {
		$form = request()->all();
		//dd($form);
		//dd(auth()->user()->hospital->id);
		// $this->validate(request(), [
		// 	'aceptabilidad_clinica' => 'required', #
		// 	'funcion_clinica' => 'required', #
		// 	'contribucion_al_servicio' => 'required',
		// 	'nivel_de_riesgo_invima' => 'required',
		// ]);

		//dd($request);
		//$form = request()->all();
		//dd($form);

		$equipo = Equipo::find($form['equipo']);

		$cm_ca = $equipo['costo_mantenimiento'] * 100 / $equipo['costo_adquisicion'];
		$cm_cc = $equipo['costo_mantenimiento'] * 100 / $equipo['costo_nuevo'];

		if ($cm_ca <= 1.75) {
			$cm_ca = 1;
		} elseif ($cm_ca > 1.75 && $cm_ca <= 3.4) {
			$cm_ca = 2;
		} elseif ($cm_ca > 3.4 && $cm_ca <= 5) {
			$cm_ca = 3;
		} else {
			$cm_ca = 4;
		}

		if ($cm_cc > 0 && $cm_cc < 5) {
			$cm_cc = 1;
		} elseif ($cm_cc >= 5 && $cm_cc <= 15) {
			$cm_cc = 2;
		} elseif ($cm_cc >= 15 && $cm_cc < 25) {
			$cm_cc = 3;
		} else {
			$cm_cc = 4;
		}
		//dd($form);
		if (!$equipo->clinicos) {
			$equipo->variable()->attach([
				18 => ['valor' => $form['Aceptabilidad_Clínica']],
				19 => ['valor' => $form['Función_Clínica']],
				20 => ['valor' => $form['Contribución_al_Servicio']],
				16 => ['valor' => $form['Nivel_de_Riesgo_INVIMA']],
				10 => ['valor' => $cm_cc],
				9 => ['valor' => $cm_ca],
			]
			);
		} else {
			$equipo->variable()->updateExistingPivot(18, ['valor' => $form['Aceptabilidad_Clínica']]);
			$equipo->variable()->updateExistingPivot(19, ['valor' => $form['Función_Clínica']]);
			$equipo->variable()->updateExistingPivot(20, ['valor' => $form['Contribución_al_Servicio']]);
			$equipo->variable()->updateExistingPivot(16, ['valor' => $form['Nivel_de_Riesgo_INVIMA']]);
			$equipo->variable()->updateExistingPivot(10, ['valor' => $cm_cc]);
			$equipo->variable()->updateExistingPivot(9, ['valor' => $cm_ca]);

		}
		$equipo->clinicos = 1;

		$equipo->save();
		return redirect('/showEquipos');
	}

	public function calcularScore(Equipo $equipo) {

		//dd($equipo['costo_adquisicion']);

		$variables = $equipo->variable;
		$score = 0;
		foreach ($variables as $variable) {
			$nivel = $variable->pivot->valor;
			//dd($variable->subcategoria->categoria->peso);
			$pesoVariable = $variable->peso;
			$pesoSub = $variable->subcategoria->peso;
			$pesoCat = $variable->subcategoria->categoria->peso;
			$acumulado = $nivel * $pesoVariable * $pesoSub * $pesoCat;
			$score = $score + $acumulado;
		}
		$equipo->score = $score;

		$equipo->save();

		// $info['nombre'] = $equipo->nombre;
		// $info['ubicacion'] = $equipo->ubicacion;
		// $info['recomendacion'] = $propuestaFinal;
		return redirect("/showEquipo/" . $equipo->id);

	}

	public function showCalculados() {
		$hospital = auth()->user()->hospital;
		$equipos = $hospital->equipos->where('score', '!=', null);
		//dd($equipos);
		$propuestas = \App\Propuesta::all();
		$propuestaFinal = "";
		$equiposFinal = array();
		foreach ($equipos as $equipo) {
			foreach ($propuestas as $propuesta) {
				// dd($propuesta->minimo);
				// dd($equipo->score);
				if ($propuesta->minimo < $equipo->score && $propuesta->maximo > $equipo->score) {
					//dd('aaa');
					$equipo->recomendacion = $propuesta->recomendacion;
					//dd($equipo);
					array_push($equiposFinal, $equipo);
				}
			}
		}
		//dd($equiposFinal);
		return view('criterios/calculados')->with('equipos', $equiposFinal);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Equipo  $equipo
	 * @return \Illuminate\Http\Response
	 */

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Equipo  $equipo
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Equipo $equipo) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Equipo  $equipo
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Equipo $equipo) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Equipo  $equipo
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Equipo $equipo) {
		//
	}

	public function tecnicos() {
		return view('tecnicos');
	}
}
