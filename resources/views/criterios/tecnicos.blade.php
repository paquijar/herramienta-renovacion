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
                        @for ($i = 0; $i < 5; $i++)
                            <div class="col-md-6 mb-3">
                                <label for="ult_tec">{{ $opciones[$i]->variable }}</label>
                                <select name="{{ $opciones[$i]->variable }}" class="form-control" required>
                                    @foreach ($opciones[$i] as $opcion)
                                        <option value="{{ $opcion->nivel }}"
                                        <?php /*    @if($opciones[5]->tecnicos)
                                                @if($opciones[6][$i]->pivot->valor==$opcion->nivel)
                                                    selected
                                                @endif
                                            @endif */ ?>
                                            >{{ $opcion->nombre }}</option>
                                    @endforeach
                                </select>
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
                            <input name="equipo" type="checkbox"  <?php /* value="{{ $opciones[5]->id }}"  */ ?> checked="checked" style="opacity:0; position:absolute;">
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
