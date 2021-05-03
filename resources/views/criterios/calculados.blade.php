@extends('layouts.app')

@section('content')
<div class="container ">
    {{-- @if($equipos->count())
 --}} @foreach ($equipos as $equipo)
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <a href="/score/{{ $equipo->id }}">
                        <h5 class="card-title">{{ $equipo->nombre }}</h5>
                    </a>
                    <ul class="list-group list-group-flush list-unstyled">
                        <li class=" card-body">Ubicación: {{ $equipo->ubicacion }}</li>
                        <li class="card-body">Recomendación: {{ $equipo->recomendacion }}</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    @endforeach
    {{-- @endif
 --}}
</div>
@endsection
