<?php

namespace App\Http\Controllers;

use App\Equipo;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->user()->authorizeRoles('user')) {
            return view('criterios/info');
        }
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
        $form = request()->all();
        $equipo = new Equipo($form);
        //dd($equipo);
        $equipo->hospital_id = auth()->user()->hospital->id;
        $equipo->save();
        //dd($equipo->id);
        $request->session()->flash('alert-success', 'Equipo Guardado');

        if ($request->user()->authorizeRoles('user')) {
            return redirect('/showEquipos');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Propuesta  $propuesta
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
        $equipo = Equipo::find($id);
        // dd($equipo);
        return view('equipo.edit', compact('equipo'));
    }

    public function update(Request $request, $id)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
        Equipo::find($id)->update($request->all());
        return redirect('/showEquipos');
    }

    public function showEquipo($id)
    {
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
        $variables = $equipo->variable;
        $score = 0;
        foreach ($variables as $variable) {
            if ($variable->id === 1) {
                if ($variable->pivot->valor === "4") {
                    $score = 4;
                    break;
                }
            }
        }
        // dd($score);
        return view('equipo.show', compact('equipo', 'score'));
        ##dd($equipos);
    }

    public function showEquipos(Equipo $equipo, Request $request)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
        $hospital = auth()->user()->hospital;

        $equipos = $hospital->equipos;
        // dd($equipos);

        /*       $variables = $cadaEquipo->variable;
        $score = 0;
        foreach ($variables as $variable) {
            if ($variable->id === 1) {
                if ($variable->pivot->valor === "4") {
                    $score = 4;
                    break;
                }
            }
        } */

        if ($request->user()->authorizeRoles('user')) {
            return view('criterios/creados')->with('equipos', $equipos);
        }
    }

    public function showSin(Equipo $equipo, Request $request)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
        $hospital = auth()->user()->hospital;
        $equipos = $hospital->equipos;
        ##dd($equipos);

        if ($request->user()->authorizeRoles('user')) {
            return view('criterios/sinCalcular')->with('equipos', $equipos);
        }
    }

    public function createTecnicos(Equipo $equipo, Request $request)
    {

        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
        $variables = \App\Diccionario_variable::categorias(0);
        unset($variables[2]);
        unset($variables[5]);
        unset($variables[6]);
        $variables = (array_values($variables));
        $opciones = array();

        foreach ($variables as $variable) {
            $opc = $variable['variable']->diccionario_variables;
            $opc->variable = $variable['variable']['nombre'];
            $opc->id = $variable['variable']['id'];
            $opc->info = $variable['variable']['informacion'];
            array_push($opciones, $opc);
        }
        $c = collect($opciones);
        $sorted = $c->sortBy('id');
        $sorted = $sorted->values();
        $opciones = array();
        foreach ($sorted as $variable) {
            array_push($opciones, $variable);
        }
        $equipoVar = 0;
        array_push($opciones, $equipo);

        if ($equipo->tecnicos) {
            $equipoVar = $equipo->variable;
            $x = 0;
            foreach ($equipoVar as $variable) {
                if (!in_array($variable->subcategoria_id, [1, 2, 3])) {
                    unset($equipoVar[$x]);
                }
                $x = $x + 1;
            }
            // dd($equipoVar);
            unset($equipoVar[1]);
            unset($equipoVar[4]);
            unset($equipoVar[5]);
            $equipoVar = ($equipoVar->values());
        }
        array_push($opciones, $equipoVar);
        //  dd($opciones);

        if ($request->user()->authorizeRoles('user')) {
            return view('criterios/tecnicos')->with('opciones', $opciones);
        }
    }

    public function createClinicos(Equipo $equipo, Request $request)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }

        $variables = \App\Diccionario_variable::categorias(1);
        $variables = (array_values($variables));
        $opciones = array();

        foreach ($variables as $variable) {
            $opc = $variable['variable']->diccionario_variables;
            $opc->variable = $variable['variable']['nombre'];
            $opc->id = $variable['variable']['id'];
            $opc->info = $variable['variable']['informacion'];
            array_push($opciones, $opc);
        }
        $c = collect($opciones);
        $sorted = $c->sortBy('id');
        $sorted = $sorted->values();
        $opciones = array();
        foreach ($sorted as $variable) {
            array_push($opciones, $variable);
        }
        $equipoVar = 0;
        array_push($opciones, $equipo);

        if ($equipo->clinicos) {
            $equipoVar = $equipo->variable;
            $x = 0;
            foreach ($equipoVar as $variable) {
                if (!in_array($variable->subcategoria_id, [4, 5])) {
                    unset($equipoVar[$x]);
                }
                $x = $x + 1;
            }
            $equipoVar = ($equipoVar->values());
        }
        array_push($opciones, $equipoVar);


        if ($request->user()->authorizeRoles('user')) {
            return view('criterios/clinicos')->with('opciones', $opciones);
        }
    }


    public function storeTecnicos(Request $request)
    {
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
        //dd($equipo);
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
        // dd($form);
        if (!$equipo->tecnicos) {
            $equipo->variable()->attach(
                [
                    1 => ['valor' => $form['Soporte_técnico_activo']],
                    2 => ['valor' => $eficiencia],
                    3 => ['valor' => $form['Porcentaje_de_operabilidad']],
                    4 => ['valor' => $form['Condición_física_del_equipo']],
                    5 => ['valor' => $vida],
                    6 => ['valor' => $tasa_falla],

                    8 => ['valor' => $form['Mantenimientos_Preventivos_(último_año)']],
                    14 => ['valor' => $form['Estado_de_Tecnología']],
                    15 => ['valor' => $form['Disponibilidad_de_Repuestos']],
                    17 => ['valor' => $form['Mediciones']],
                    21 => ['valor' => $form['Disponibilidad_de_equipos_de_respaldo']],


                ]
            );
        } else {
            $equipo->variable()->updateExistingPivot(1, ['valor' => $form['Soporte_técnico_activo']]);
            $equipo->variable()->updateExistingPivot(2, ['valor' =>  $eficiencia]);
            $equipo->variable()->updateExistingPivot(3, ['valor' => $form['Porcentaje_de_operabilidad']]);
            $equipo->variable()->updateExistingPivot(4, ['valor' => $form['Condición_física_del_equipo']]);
            $equipo->variable()->updateExistingPivot(5, ['valor' => $vida]);
            $equipo->variable()->updateExistingPivot(6, ['valor' => $tasa_falla]);

            $equipo->variable()->updateExistingPivot(8, ['valor' => $form['Mantenimientos_Preventivos_(último_año)']]);
            $equipo->variable()->updateExistingPivot(14, ['valor' => $form['Estado_de_Tecnología']]);
            $equipo->variable()->updateExistingPivot(15, ['valor' => $form['Disponibilidad_de_Repuestos']]);
            $equipo->variable()->updateExistingPivot(17, ['valor' => $form['Mediciones']]);
            $equipo->variable()->updateExistingPivot(21, ['valor' => $form['Disponibilidad_de_equipos_de_respaldo']]);
        }
        $equipo->tecnicos = 1;
        $equipo->score = null;
        //dd($equipo);
        $equipo->save();
        return redirect('/showEquipos');
    }

    public function storeClinicos(Request $request)
    {
        $form = request()->all();

        //  dd($form);
        // dd(auth()->user()->hospital->id);
        // $this->validate(request(), [
        // 	'aceptabilidad_clinica' => 'required', #
        // 	'funcion_clinica' => 'required', #
        // 	'contribucion_al_servicio' => 'required',
        // 	'nivel_de_riesgo_invima' => 'required',
        // ]);

        //dd($request);
        //$form = request()->all();
        // dd($form);


        $equipo = Equipo::find($form['equipo']);
        //dd($equipo);
        // dd($equipo);

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
            $equipo->variable()->attach(
                [
                    18 => ['valor' => $form['Aceptabilidad_Clínica']],
                    19 => ['valor' => $form['Función_Clínica']],
                    22 => ['valor' => $form['Facilidad_de_uso_del_equipo']],
                    23 => ['valor' => $form['Contribución_del_equipo_al_servicio']],
                    7 => ['valor' => $form['Eventos_adversos_reportados']],
                    11 => ['valor' => $form['Fecha_finalización_registro_INVIMA_']],
                    12 => ['valor' => $form['Factor_ético']],
                    13 => ['valor' => $form['Factor_medio_ambiental']],
                    16 => ['valor' => $form['Clasificación_nivel_de_riesgo_del_equipo']],
                    20 => ['valor' => $form['Prohibición_del_equipo_localmente']],
                    10 => ['valor' => $cm_cc],
                    9 => ['valor' => $cm_ca],
                ]
            );
        } else {
            $equipo->variable()->updateExistingPivot(18, ['valor' => $form['Aceptabilidad_Clínica']]);
            $equipo->variable()->updateExistingPivot(19, ['valor' => $form['Función_Clínica']]);
            $equipo->variable()->updateExistingPivot(22, ['valor' => $form['Facilidad_de_uso_del_equipo']]);
            $equipo->variable()->updateExistingPivot(23, ['valor' => $form['Contribución_del_equipo_al_servicio']]);
            $equipo->variable()->updateExistingPivot(7, ['valor' => $form['Eventos_adversos_reportados']]);
            $equipo->variable()->updateExistingPivot(11, ['valor' => $form['Fecha_finalización_registro_INVIMA_']]);
            $equipo->variable()->updateExistingPivot(12, ['valor' => $form['Factor_ético']]);
            $equipo->variable()->updateExistingPivot(13, ['valor' => $form['Factor_medio_ambiental']]);
            $equipo->variable()->updateExistingPivot(16, ['valor' => $form['Clasificación_nivel_de_riesgo_del_equipo']]);
            $equipo->variable()->updateExistingPivot(20, ['valor' => $form['Prohibición_del_equipo_localmente']]);
            $equipo->variable()->updateExistingPivot(10, ['valor' => $cm_cc]);
            $equipo->variable()->updateExistingPivot(9, ['valor' => $cm_ca]);
        }
        $equipo->clinicos = 1;
        $equipo->score = null;
        // dd($equipo->score);
        $equipo->save();
        return redirect('/showEquipos');
    }

    public function calcularScore(Equipo $equipo)
    {

        //dd($equipo['costo_adquisicion']);

        $variables = $equipo->variable;
        $score = 0;
        foreach ($variables as $variable) {
            if ($variable->id === 7 || $variable->id === 12 || $variable->id === 20) {
                if ($variable->pivot->valor === "4") {
                    $score = 4;
                    break;
                }
            }
            $nivel = $variable->pivot->valor;
            //dd($variable->subcategoria->categoria->peso);
            $pesoVariable = $variable->peso;
            $pesoSub = $variable->subcategoria->peso;
            $pesoCat = $variable->subcategoria->categoria->peso;
            if (is_numeric($nivel)) {
                $acumulado = $nivel * $pesoVariable * $pesoSub * $pesoCat;
                $score = $score + $acumulado;
            }
        }

        $equipo->score = $score;

        $equipo->save();

        // $info['nombre'] = $equipo->nombre;
        // $info['ubicacion'] = $equipo->ubicacion;
        // $info['recomendacion'] = $propuestaFinal;
        return redirect("/showEquipo/" . $equipo->id);
    }

    public function showCalculados(Request $request)
    {
        if ($request->user()->authorizeRoles('admin')) {
            return view("homeAdmin");
        }
        if ($request->user()->authorizeRoles('superadmin')) {
            return view("homeSuperadmin");
        }
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
            $variables = $equipo->variable;
            $score = 0;
            foreach ($variables as $variable) {
                if ($variable->id === 1) {
                    if ($variable->pivot->valor === "4") {
                        $score = 4;
                        $equipo->score = $score;
                    }
                }
            }
        }
        //dd($equiposFinal);
        if ($request->user()->authorizeRoles('user')) {
            return view('criterios/calculados')->with('equipos', $equiposFinal);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Equipo  $equipo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipo $equipo)
    {
        //
    }

    public function tecnicos()
    {
        return view('tecnicos');
    }
}
