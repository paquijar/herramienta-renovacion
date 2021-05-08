@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 text-center" style="color:rgba(255, 255, 255, 0.8); padding-top:20px">
            <div class="card" style="margin: top 300px;">
                <div class="card-header">Información de la Subcategoría</div>
                <br></br>
                <div class="card-body">
                    <form method="POST" action="/diccionario_variable/{{ $diccionario_variable->id }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="nombre">Nombre*</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $diccionario_variable->nombre }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="nivel">Nivel*</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="nivel" name="nivel" required value="{{ $diccionario_variable->nivel }}">
                            </div>
                        </div>
                        <br></br>
                        <div class="form-group row mb-0">
                            <div class="col">
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
<!--
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

                            <input type="text" class="form-control" id="nivel" name="nivel" value="{{ $diccionario_variable->nivel }}">

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
</div> -->
@endsection
