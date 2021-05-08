@extends('layouts.app')

@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $equipo->nombre }}</h5>
                    <ul class="list-group list-group-flush list-unstyled">
                        <li class="card-body">Ubicación: {{ $equipo->ubicacion }}</li>
                        <li class="card-body">Recomendación: {{ $equipo->recomendacion }}</li>
                        <li class="card-body">Edad: {{ $equipo->edad }}</li>
                        @if ($score==4)
                        <li class="card-body">Por normatividad es necesario que el equipo que se encuentra operando tenga un contrato de mantenimiento activo</li>
                        @endif
                    </ul>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
