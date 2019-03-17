@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1> Gestión de Archivos </h1>

                </div>


                Subir Archivo:
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" id="image" name="image" placeholder="Cargar Archivo">
                    <button type="submit" class="btn btn-primary"> Subir </button>
                </form>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Nombre Archivo</th>
                            <th scope="col">Url</th>
                            <th scope="col">Borrar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                        <tr>
                            <td>{{ $file->file_name }}</td>
                            <td>{{ $file->file_url }}</td>
                            <td>
                                    <form method="POST" action=" {{ route('created_files.delete' , ['id' => $file->id]) }}">
                                            @csrf
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
