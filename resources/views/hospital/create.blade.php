@extends('layouts.superadmin')

@section('content')
<div class="row">
    <div class="container ">
        <div class="row ">
            <div class="col-md-8">
                <div class="text-center">
                    <h3>Crear Institución de salud</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/hospital">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre*</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="direccion" class="col-md-4 col-form-label text-md-right">Dirección*</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="direccion" name="direccion" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="telefono" class="col-md-4 col-form-label text-md-right">Teléfono</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="telefono" name="telefono">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nivel" class="col-md-4 col-form-label text-md-right">Nivel*</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" id="nivel" name="nivel" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
