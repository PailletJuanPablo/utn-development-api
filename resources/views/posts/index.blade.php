@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1> Gestión de Novedades </h1>
                </div>
                <a class="btn btn-primary" href="{{ route('posts.create') }}"> Agregar nueva Novedad </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $element)
                        <tr>
                            <th scope="row">{{ $element->id }}</th>
                            <td>{{ $element->title }}</td>
                            <td>
                                <a style="width:100%" class="btn btn-secondary" href="{{ route('posts.edit' , ['id' => $element->id]) }}"> Editar </a>
                                <form method="POST" action=" {{ route('posts.destroy' , ['id' => $element->id]) }}">
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