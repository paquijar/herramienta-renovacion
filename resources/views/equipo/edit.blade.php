@extends('layouts.app')

@section('content')
<div class="row">
    <div class="container ">
        <div class="row ">
            <div class="col" style="color:rgba(255, 255, 255, 0.8);">
                <br></br>
                <div class="text-center">
                    <h3><strong>
                            Editar Equipo
                        </strong></h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/equipo/{{ $equipo->id }}/update">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Nombre del equipo*</label>
                            <div class="col-md-5">
                                <input type="text" value="{{$equipo->nombre}}" class="form-control" id="nombre" name="nombre" placeholder="" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Marca</label>
                            <div class="col-md-5"><input value="{{$equipo->marca}}" type="text" class="form-control" id="marca" placeholder="" name="marca">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Serie</label>
                            <div class="col-md-5"><input value="{{$equipo->serie}}" type="text" class="form-control" id="serie" placeholder="" name="serie">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Ubicación*</label>
                            <div class="col-md-5"><input value="{{$equipo->ubicacion}}" type="text" class="form-control" id="ubicacion" placeholder="" name="ubicacion" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Código dentro de la institución</label>
                            <div class="col-md-5"><input value="{{$equipo->codigo}}" type="text" class="form-control" id="codigo" placeholder="" name="codigo">
                            </div>
                        </div>

                        {{-- Lo siguiente calcula la relacion edad y vida util --}}


                        <!--   <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Edad*</label>
                            <div class="col-md-5"><input value="{{$equipo->nombre}}" type="text" class="form-control" id="edad" placeholder="" name="edad" required>
                        </div> -->
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Vida útil del equipo (años)*</label>
                            <div class="col-md-5">
                                <input value="{{$equipo->vida_util}}" type="number" min="1" class="form-control" id="vida_util" placeholder="" name="vida_util" required>
                            </div>
                        </div>


                        {{-- Lo siguiente los criterios economicos --}}


                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Costo de adquisición del equipo*</label>
                            <div class="col-md-5"><input value="{{$equipo->costo_adquisicion}}" min="1" type="number" class="form-control" id="costo_adquisicion" placeholder="" name="costo_adquisicion" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Costo de renovación del equipo*</label>
                            <div class="col-md-5"><input value="{{$equipo->costo_nuevo}}" min="1" type="number" class="form-control" id="costo_nuevo" placeholder="" name="costo_nuevo" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="firstName">Costo contrato de mantenimiento (anual)*</label>
                            <div class="col-md-5"><input value="{{$equipo->costo_mantenimiento}}" min="1" type="number" class="form-control" id="costo_mantenimiento" placeholder="" name="costo_mantenimiento" required>
                            </div>
                        </div>

                        {{-- Lo siguiente calcula eficiencia y tasa de falla --}}


                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="parado">Tiempo de inactividad del equipo (horas)*</label>
                            <div class="col-md-5"><input value="{{$equipo->tiempo_parado}}" type="number" min="0" class="form-control" id="tiempo_parado" placeholder="" name="tiempo_parado" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="operacion">Tiempo de actividad del equipo (horas)*</label>
                            <div class="col-md-5"><input value="{{$equipo->tiempo_operacion}}" type="number" min="0" class="form-control" id="tiempo_operacion" placeholder="" name="tiempo_operacion" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="reparaciones">Mantenimientos correctivos*</label>
                            <div class="col-md-5"><input value="{{$equipo->nro_reparaciones}}" type="number" min="0" class="form-control" id="nro_reparaciones" placeholder="" name="nro_reparaciones" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="años_rep">Número de años en los que se hicieron los mantenimientos correctivos*</label>
                            <div class="col-md-5"><input value="{{$equipo->años_reparaciones}}" type="number" min="0" class="form-control " id="años_reparaciones" placeholder="" name="años_reparaciones" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="años_rep">Edad del equipo (años)*</label>
                            <div class="col-md-5"><input value="{{$equipo->edad}}" min="1" type="number" class="form-control" id="edad" placeholder="" name="edad" required>
                            </div>
                        </div>
                        <br></br>
                        <div class="form-group row ">
                            <div class="col align-self-center text-center">
                                <button type="submit" class="btn btn-info">
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
