@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informacion de la propuesta</div>
                <div class="card-body">
                    <form method="POST" action="/propuesta/{{ $propuesta->id }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="col-md-6 mb-3">
                            <label for="minimo">Minimo*</label>
                            <input type="text" class="form-control" id="minimo" name="minimo" value="{{ $propuesta->minimo }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="maximo">Maximo*</label>
                            <input type="text" class="form-control" id="maximo" name="maximo" value="{{ $propuesta->maximo }}" >
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="recomendacion">Recomendacion*</label>
                            <input type="text" class="form-control" id="recomendacion" value="{{ $propuesta->recomendacion }}"  name="recomendacion" >
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
