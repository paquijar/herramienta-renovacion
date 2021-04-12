@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="container ">
    <div class="row ">
        <div class="col-md-8" >
              <div ><h3>Variables</h3></div>
              <div class="table-container">
                <table id="mytable" class="table table-bordred table-striped" >
                  <thead>
                    <th>Nombre</th>
                    <th>Peso</th>
                    <th>Subcategoría</th>
                    <th>Editar</th>
                    <th></th>
                  {{--                <th>Eliminar</th> --}}
                  </thead>
                  <tbody>
                    @if($variables->count())
                      @foreach($variables as $variable)
                        <tr>
                          <td>{{$variable->nombre}}</td>
                          <td>{{$variable->peso}}</td>
                          <td>{{$variable->subcategoria->nombre}}</td>
                          <td><a class="btn btn-primary btn-xs" href="/variable/{{ $variable->id }}/edit" >Editar<span class="glyphicon glyphicon-pencil"></span></a></td>
                          <td><a class="btn btn-primary btn-xs" href="/diccionario/{{ $variable->id }}" >Editar Opciones<span class="glyphicon glyphicon-pencil"></span></a></td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                      <td colspan="8">No hay registro !!</td>
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




