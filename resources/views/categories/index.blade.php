@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1> Gestión de Categorías </h1>
                </div>

                <a class="btn btn-primary" href="{{ route('categories.create') }}"> Agregar nueva Categoría </a>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $element)
                        <tr>
                            <th scope="row">{{ $element->id }}</th>
                            <td>{{ $element->name }}</td>
                            <td>
                                <a style="width:100%" class="btn btn-secondary" href="{{ route('categories.edit' , ['id' => $element->id]) }}"> Editar  </a>
                                <form method="POST" action=" {{ route('categories.destroy' , ['id' => $element->id]) }}">
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