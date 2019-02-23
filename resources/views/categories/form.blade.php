@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="card">
            <div class="card-heading">
                <h1> {{ isset($category) ? 'Editar Categoría' : 'Agregar Categoría' }} </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($category) ? route('categories.update', ['id'=>$category->id]) : route('categories.store')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="name">Titulo categoría</label>
                        <br>
                        <input type="text" id="name" name="name" value="{{ isset($category) ? $category->name : ''}}" placeholder="Ingresar aquí">
                    </div>

                    @if (isset($category))
                    <input name="_method" type="hidden" value="PUT">

                    <input type="hidden" name="id" value="{{ $category->id }}">
                    @endif
                 

                    
                    <button type="submit" class="btn btn-primary"> {{ isset($category) ? 'Actualizar' : 'Crear' }} </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection