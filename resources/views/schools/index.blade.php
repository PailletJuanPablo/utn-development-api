@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1> Gestión de Escuelas </h1>
                </div>

                <a class="btn btn-primary" href="{{ route('schools.create') }}"> Agregar nueva Escuela </a>

                <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Imagen</th>
                            <th scope="col">Edicion</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                            <tr>
                                    <th scope="row">{{ $school->id }}</th>
                                    <td>{{ $school->name }}</td>
                                    <td> <img width="200" src="{{ $school->image }}"> </td>
                                    <td>
                                            <a style="width:100%" class="btn btn-secondary" href="{{ route('schools.edit' , ['id' => $school->id]) }}"> Editar  </a>
                                          
                                            <form method="POST" action=" {{ route('schools.destroy' , ['id' => $school->id]) }}">
                                          
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">

                                            <button class="btn btn-danger" href=""> Eliminar </button>
                                            </form>
                                    </td>
                                  </tr>
                            @endforeach
                       
                        </tbody>
                      </table>
            </div>
        </div>
    </div>
</div>
@endsection