@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="card">
            <div class="card-heading">
                <h1> {{ isset($school) ? 'Editar Escuela' : 'Agregar Escuela' }} </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($school) ? route('schools.update', ['id'=>$school->id]) : route('schools.store')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Nombre de Escuela</label>
                        <br>
                        <input type="text" id="name" name="name" value="{{ isset($school) ? $school->name : ''}}" placeholder="Ingresar aquí">
                    </div>

                    @if (isset($school))
                    <input name="_method" type="hidden" value="PUT">

                    <input type="hidden" name="id" value="{{ $school->id }}">
                    <h3> Imagen </h3>
                    <img src="{{ $school->image }}" width="400"> @endif

                    <div class="form-group">
                        <label for="image">Imagen</label>
                        <br>
                        <input type="file" name="image" id="image">
                    </div>

                    
                    <button type="submit" class="btn btn-primary"> {{ isset($school) ? 'Actualizar' : 'Crear' }} </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection