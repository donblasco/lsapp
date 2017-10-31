@extends('layouts.app')
@section('content')
    <h1>Editar Post</h1>

    {!! Form::open(['action' => ['PostsController@update',$post->id], 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Titulo')}}
            {{Form::text('title',$post->title,['class' => 'form-control','placeholder' => 'Titulo'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Cuerpo')}}
            {{Form::textarea('body',$post->body,['id'=> 'article-ckeditor','class' => 'form-control','placeholder' => 'Contenido de la nota'])}}
        </div>
         <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Enviar',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection