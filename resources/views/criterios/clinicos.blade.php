@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header text-center">Criterios de Usuario Final</div>
                <div class="card-body">
                    <form method="POST" action="/clinicos">
                        {{ csrf_field() }}
                        @for ($i = 0; $i < count($opciones)-2; $i++) <div class="col-8 mx-auto">
                            <label style="margin-top:30px" for="ult_tec">{{ $opciones[$i]->variable }}</label>
                            <span style="cursor:default" data-toggle="tooltip" data-placement="top" title="{{$opciones[$i]->info}}" class="material-icons">info </span>
                            @if(empty($opciones[$i][0]))
                            @if(is_a($opciones[count($opciones)-1], 'Illuminate\Database\Eloquent\Collection'))
                            @if($opciones[$i]->id==11)
                            <input type="date" name="{{ $opciones[$i]->variable }}" value="{{ $opciones[count($opciones)-1][$i]->pivot->valor }}" class="form-control" required>
                            @else
                            <input type="number" min="0" name="{{ $opciones[$i]->variable }}" value="{{ $opciones[count($opciones)-1][$i]->pivot->valor }}" class="form-control" required>
                            @endif
                            @else
                            @if($opciones[$i]->id==11)
                            <input type="date" name="{{ strtotime($opciones[$i]->variable) }}" class="form-control" required>
                            @else
                            <input type="number" min="0" name="{{ $opciones[$i]->variable }}" class="form-control" required>
                            @endif
                            @endif
                            @else
                            <select name="{{ $opciones[$i]->variable }}" class="form-control" required>
                                @foreach ($opciones[$i] as $opcion)
                                <option value="{{ $opcion->nivel }}" @if($opciones[count($opciones)-2]->tecnicos)
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
                <br></br>
                <div class="form-group row mb-0">
                    <div class="col text-center">
                        <button type="submit" class="btn btn-info">
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
