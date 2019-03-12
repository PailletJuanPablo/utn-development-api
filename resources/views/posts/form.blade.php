@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-12 col-md-offset-1">
        <div class="card">
            <div class="card-heading">
                <h1> {{ isset($post) ? 'Editar Novedad' : 'Agregar Novedad' }} </h1>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ isset($post) ? route('posts.update', ['id'=>$post->id]) : route('posts.store')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title">Titulo del post</label>
                        <br>
                        <input type="text" id="title" name="title" value="{{ isset($post) ? $post->title : ''}}" placeholder="Ingresar aquí">
                    </div>


                    <div class="form-group">
                        <label for="featured">Destacar (se mostrará en slider principal de app)</label>
                        <br>
                        <select name="featured">
                            <option value="1"> SI </option>
                            <option value="0"> NO </option>
                        </select>
                    </div>



                    @if (isset($post))

                    <img src="{{ $post->image }}" width="500">
                    <input name="_method" type="hidden" value="PUT">

                    <input type="hidden" name="id" value="{{ $post->id }}"> @endif

                    <div class="form-group">
                        <label for="image">Imagen del post</label>
                        <br>
                        <input type="file" id="image" name="image" placeholder="Cargar imagen">
                    </div>


                    <div class="form-group">
                        <label for="image">Contenido del post</label>
                        <br>
                        <textarea class="ckeditor" name="content" id="editor1" rows="10" cols="80">
                                @if (isset($post))

                                {{ $post->content }}

                                @endif
                                </textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Categoría de la novedad</label>
                        <br>

                        <select name="category_id">

                            @foreach ($categories as $category)
                            <option
                            @if(isset($post) && $post->category_id && $post->category_id == $category->id)
                            selected
                            @endif
                            value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Pertenece a alguna escuela?</label>
                        <label> Seleccione si fuese necesario </label>
                        <br>

                        <select multiple="multiple" name="schools[]" id="schools">

                            @foreach ($schools as $school)
                            <option

                            @isset($post)
                            @foreach ($post->schools as $postSchool)
                                @if ($postSchool->school_id == $school->id)
                                    selected
                                @endif
                            @endforeach
                            @endisset

                            value="{{ $school->id }}">
                            {{ $school->name }}

                            </option>


                            @endforeach

                            </select>


                    </div>

                    <button type="submit" class="btn btn-primary"> {{ isset($post) ? 'Actualizar' : 'Crear' }} </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
