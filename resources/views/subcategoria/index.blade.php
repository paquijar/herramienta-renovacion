@extends('layouts.admin')
@section('content')
<div class="row">
  <div class="container ">
    <div class="row ">
        <div class="col-md-8" >
              <div ><h3>Subcategorias</h3></div>
              <div class="table-container">
                <table id="mytable" class="table table-bordred table-striped" >
                 <thead>
                   <th>Nombre</th>
                   <th>Peso</th>
                   <th>Categoría</th>
                   <th>Editar</th>
    {{--                <th>Eliminar</th> --}}
                 </thead>
                 <tbody>
                  @if($subcategorias->count())
                  @foreach($subcategorias as $subcategoria)
                  <tr>
                    <td>{{$subcategoria->nombre}}</td>
                    <td>{{$subcategoria->peso}}</td>
                    <td>{{$subcategoria->categoria->nombre}}</td>
                    <td><a class="btn btn-primary btn-xs" href="/subcategoria/{{ $subcategoria->id }}/edit" >Editar<span class="glyphicon glyphicon-pencil"></span></a></td>
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




