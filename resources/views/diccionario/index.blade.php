@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="container ">
        <div class="row ">
            <div class="col-md-8">
                <br></br>
                <div>
                    <h3><strong>
                            Opciones
                        </strong></h3>
                </div>
                <div class="table-container">
                    <table id="mytable" class="table table-bordred table-striped">
                        <thead>
                            <th>Nombre</th>
                            <th style="text-align: center">Nivel (Más alto, afecta negativamente el score)</th>
                            <th>Editar</th>
                            {{-- <th>Eliminar</th> --}}
                        </thead>
                        <tbody>
                            @if($diccionario_variables->count())
                            @foreach($diccionario_variables as $diccionario_variable)
                            <tr>
                                <td>{{$diccionario_variable->nombre}}</td>
                                <td style=" text-align: center">{{$diccionario_variable->nivel}}</td>
                                <td><a class=" btn btn-info btn-xs" href="/diccionario_variable/{{ $diccionario_variable->id }}/edit">Editar<span class="glyphicon glyphicon-pencil"></span></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="8">
                                    <h3> VALOR DADO POR EL USUARIO</h3>
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
