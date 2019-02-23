@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1> Gestión de Secciones </h1>
                </div>
                <a class="btn btn-primary" href="{{ route('pages.create') }}"> Agregar nueva Sección </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pages as $element)
                        <tr>
                            <th scope="row">{{ $element->id }}</th>
                            <td>{{ $element->title }}</td>
                            <td>
                                <a style="width:100%" class="btn btn-secondary" href="{{ route('pages.edit' , ['id' => $element->id]) }}"> Editar </a>
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