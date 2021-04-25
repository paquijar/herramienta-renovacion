@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Información del equipo</div>
                <div class="card-body">
                    <form method="POST" action="/equipo">
                    {{ csrf_field() }}
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Nombre del equipo*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Marca</label>
                            <input type="text" class="form-control" id="marca" placeholder="" name="marca" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Serie</label>
                            <input type="text" class="form-control" id="serie" placeholder="" name="serie" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Ubicación*</label>
                            <input type="text" class="form-control" id="ubicacion" placeholder="" name="ubicacion" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Código dentro de la institución</label>
                            <input type="text" class="form-control" id="codigo" placeholder="" name="codigo" >
                        </div>


                        {{-- Lo siguiente calcula la relacion edad y vida util --}}


                      <!--   <div class="col-md-6 mb-3">
                            <label for="firstName">Edad*</label>
                            <input type="text" class="form-control" id="edad" placeholder="" name="edad" required>
                        </div> -->
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Vida Útil del equipo (años)*</label>
                            <input type="text" class="form-control" id="vida_util" placeholder="" name="vida_util" required>
                        </div>


                        {{-- Lo siguiente los criterios economicos --}}


                        <div class="col-md-6 mb-3">
                            <label for="firstName">Costo de adquisición del equipo*</label>
                            <input type="text" class="form-control" id="costo_adquisicion" placeholder="" name="costo_adquisicion" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Costo de renovación del equipo*</label>
                            <input type="text" class="form-control" id="costo_nuevo" placeholder="" name="costo_nuevo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="firstName">Costo contrato de mantenimiento (anual)*</label>
                            <input type="text" class="form-control" id="costo_mantenimiento" placeholder="" name="costo_mantenimiento" required>
                        </div>


                        {{-- Lo siguiente calcula eficiencia y tasa de falla --}}


                        <div class="col-md-6 mb-3">
                            <label for="parado">Tiempo de inactividad del equipo (horas)*</label>
                            <input type="text" class="form-control" id="tiempo_parado" placeholder="" name="tiempo_parado" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="operacion">Tiempo de actividad del equipo (horas)*</label>
                            <input type="text" class="form-control" id="tiempo_operacion" placeholder="" name="tiempo_operacion" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="reparaciones">Mantenimientos correctivos último año*</label>
                            <input type="text" class="form-control" id="nro_reparaciones" placeholder="" name="nro_reparaciones" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="años_rep">Número de años en los que se hicieron los mantenimientos correctivos*</label>
                            <input type="text" class="form-control col-md-6" id="años_reparaciones" placeholder="" name="años_reparaciones" required>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="años_rep">Edad del equipo (años)*</label>
                            <input type="text" class="form-control col-md-6" id="edad" placeholder="" name="edad" required>
                        </div>


                        <div class="form-group row ">
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
