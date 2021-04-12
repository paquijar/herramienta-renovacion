@extends('layouts.app')

@section('content')
<div class="flash-message">
      @if(Session::has('alert-succes'))

      <p class="alert alert-succes">{{ Session::get('alert-succes') }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
      @endif
  </div>
<div class="container ">
{{--     @if($equipos->count())
 --}}    @foreach ($equipos as $equipo)
        @if($equipo->score==null)
        <div class="row justify-content-center">
            <div class="col-md-12" >
                <div class="card mb-3" >
                    <div class="card-body">
                        <h3 class="card-title">{{ $equipo->nombre }}</h5>

                          @if($equipo->tecnicos==0)
                            <p style="color:green;" class="card-title">Faltan los criterios técnicos</p>
                          @endif
                          @if($equipo->clinicos==0)
                            <p style="color:green;" class="card-title">Faltan los criterios del usuario final</p>
                          @endif

                            <a href="/createTecnicos/{{ $equipo->id }}" class="btn btn-info">Criterios Técnicos</a>
                            <a href="/createClinicos/{{ $equipo->id }}" class="btn btn-info">Criterios Usuario Final</a>
                            @if($equipo->tecnicos==1 && $equipo->clinicos==1)
                              <a href="/score/{{ $equipo->id }}" class="btn btn-info">Calcular</a>
                            @endif
                    </div>
                </div>

            </div>
        </div>
        @endif
    @endforeach
{{--     @endif
 --}}</div>
@endsection




