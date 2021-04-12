@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informacion de las Opciones</div>
                <div class="card-body">
                    <form method="POST" action="/diccionario_variable/{{ $diccionario_variable->id }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="col-md-6 mb-3">
                            <label for="nombre">Nombre*</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $diccionario_variable->nombre }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nivel">Nivel*</label>
                            <input type="text" class="form-control" id="nivel" name="nivel" value="{{ $diccionario_variable->nivel }}" >
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
