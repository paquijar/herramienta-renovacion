@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 text-center" style="color:rgba(255, 255, 255, 0.8); padding-top:20px">
            <div class="card" style="margin: top 300px;">
                <div class="card-header">Informacion de la recomendación final</div>
                <br></br>
                <div class="card-body">
                    <form method="POST" action="/propuesta/{{ $propuesta->id }}">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PATCH">
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="minimo">Mínimo*</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="minimo" name="minimo" value="{{ $propuesta->minimo }}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="maximo">Máximo*</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="maximo" name="maximo" value="{{ $propuesta->maximo }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-md-right" for="recomendacion">Recomendación*</label>
                            <div class="col-md-5">
                                <input type="text" class="form-control" id="recomendacion" value="{{ $propuesta->recomendacion }}" name="recomendacion">
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
<!-- <div class="container">
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
                            <input type="text" class="form-control" id="maximo" name="maximo" value="{{ $propuesta->maximo }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="recomendacion">Recomendacion*</label>
                            <input type="text" class="form-control" id="recomendacion" value="{{ $propuesta->recomendacion }}" name="recomendacion">
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
