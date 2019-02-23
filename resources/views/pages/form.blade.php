@extends('layouts.app') 
@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="card">
            <div class="card-heading">
                <h1> {{ isset($page) ? 'Editar Sección' : 'Agregar Sección' }} </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($page) ? route('pages.update', ['id'=>$page->id]) : route('pages.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Titulo del sección</label>
                        <br>
                        <input type="text" id="title" name="title" value="{{ isset($page) ? $page->title : ''}}" placeholder="Ingresar aquí">
                    </div>
                    @if (isset($page))
                    <img src="{{ $page->image }}" width="500">
                    <input name="_method" type="hidden" value="PUT">
                    <input type="hidden" name="id" value="{{ $page->id }}"> @endif
                    <div class="form-group">
                        <label for="image">Titulo de sección</label>
                        <br>
                        <input type="file" id="image" name="image" placeholder="Cargar imagen">
                    </div>
                    <div class="form-group">
                        <label for="image">Contenido de página</label>
                        <br>
                        <textarea class="ckeditor" name="content" id="editor1" rows="10" cols="80">
                                @if (isset($page))
                                {{ $page->content }}
                                @endif
                                </textarea>
                    </div>
                   

                    <button type="submit" class="btn btn-primary"> {{ isset($page) ? 'Actualizar' : 'Crear' }} </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection