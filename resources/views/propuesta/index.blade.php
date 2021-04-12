@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="container ">
    <div class="row ">
        <div class="col-md-8" >
              <div ><h3>Propuestas</h3></div>
              <div class="table-container">
                <table id="mytable" class="table table-bordred table-striped" >
                 <thead>
                   <th>Minimo</th>
                   <th>Maximo</th>
                   <th>Recomendacion</th>
                   <th>Editar</th>
    {{--                <th>Eliminar</th> --}}
                 </thead>
                 <tbody>
                  @if($propuestas->count())
                  @foreach($propuestas as $propuesta)
                  <tr>
                    <td>{{$propuesta->minimo}}</td>
                    <td>{{$propuesta->maximo}}</td>
                    <td>{{$propuesta->recomendacion}}</td>
                    <td><a class="btn btn-primary btn-xs" href="/propuesta/{{ $propuesta->id }}/edit" >Editar<span class="glyphicon glyphicon-pencil"></span></a></td>
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




