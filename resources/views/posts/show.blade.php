@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Volver a las noticias</a>
    <h1>{{$post->title}}</h1>
    <img style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
    <br><br>
    <div>
    {!!$post->body!!}
    </div>  
    <hr>
    <small>Publicado el {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    @if(!Auth::guest())
        <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

        {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'metod' => 'POST', 'class'=> 'pull-right']) !!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Eliminar',['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}
    @endif
@endsection