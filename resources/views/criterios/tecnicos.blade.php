@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Criterios Técnicos</div>
                <div class="card-body">
                    <form method="POST" action="/tecnicos">
                        {{ csrf_field() }}
                        @for ($i = 0; $i < count($opciones)-2; $i++) <div class="col-md-6 mb-3">
                            <label title="{{$opciones[$i]->info}}" for="ult_tec">{{ $opciones[$i]->variable }}</label>
                                @if(empty($opciones[$i][0]))
                                    @if(is_a($opciones[count($opciones)-1], 'Illuminate\Database\Eloquent\Collection'))
                                        <input type="text" name="{{ $opciones[$i]->variable }}" value="{{ $opciones[count($opciones)-1][$i]->pivot->valor }}"  class="form-control" required>
                                    @else
                                     <input type="text" name="{{ $opciones[$i]->variable }}" class="form-control" required>
                                    @endif
                                @else
                                    <select name="{{ $opciones[$i]->variable }}" class="form-control" required>
                                    @foreach ($opciones[$i] as $opcion)
                                        <option value="{{ $opcion->nivel }}"
                                            @if($opciones[count($opciones)-2]->tecnicos)
                                                @if(is_a($opciones[count($opciones)-1], 'Illuminate\Database\Eloquent\Collection'))
                                                    @if($opciones[count($opciones)-1][$i]->pivot->valor== strval($opcion->nivel))
                                                        selected
                                                    @endif
                                                @endif
                                            @endif
                                        >{{ $opcion->nombre }}</option>
                                    @endforeach
                                    </select>
                                @endif
                            </div>
                        @endfor

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ 'Guardar' }}
                        </button>
                    </div>
                </div>
                <div>
                    <input name="equipo" type="checkbox" value="{{ $opciones[(count($opciones)-2)]->id }}" checked="checked" style="opacity:0; position:absolute;">
                </div>
                </form>
            </div>

        </div>
    </div>
</div>
</div>
@endsection
