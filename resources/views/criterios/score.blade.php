@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Criterios Tecnicos</div>
                <div class="card-body">
                    <form method="POST" action="/clinicos">
                    {{ csrf_field() }}

                        <div class="col-md-6 mb-3">
                            <label for="acep_clin">Aceptabilidad Clinica</label>
                            <select name="aceptabilidad" class="form-control" required>
                              <option value="1">El Equipo Satisface Completamente las Necesidades Clínicas de la Instalacion</option>
                              <option value="2">El Equipo Satisface Solamente las Necesidades Clínicas Básicas</option>
                              <option value="4">El Equipo ya no Satisface las Necesidades Clínicas</option>
                              <option value="4">Sin Informacion</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="func_clini">Funcion Clinica</label>
                            <select name="funcion_clinica" class="form-control" required>
                              <option value="1">Otro</option>
                              <option value="2">Diagnóstico</option>
                              <option value="3">Terapéutico</option>
                              <option value="4">Soporte Vital</option>
                              <option value="4">Sin Informacion</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="contri_serv">Contribucion al Servicio</label>
                            <select name="contribucion_servicio" class="form-control" required>
                              <option value="1">Su Ausencia No Afecta El Funcionamiento Del Servicio</option>
                              <option value="3">Equipo Importante Pero No Indispensable En El Servicio</option>
                              <option value="4">Indispensable En El Funcionamiento Del Servicio</option>
                              <option value="4">Sin Informacion</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="riesgo">Nivel de Riesgo Segun el INVIMA</label>
                            <select name="riesgo" class="form-control" required>
                              <option value="1">CLASE I</option>
                              <option value="2">CLASE IIa</option>
                              <option value="3">CLASE IIb</option>
                              <option value="4">CLASE III</option>
                              <option value="4">Sin Informacion</option>
                            </select>
                        </div>


                        <div>
                            <input name="equipo" type="text" value="{{ $equipo }}" style="opacity:0; position:absolute;">
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ 'Siguiente' }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
