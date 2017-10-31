@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <a href="/posts/create" class="btn btn-primary">Crear Post</a>
                    <h3>Tus posteos</h3>
                    @if(count($posts)>0);
                    <table class="table table-striped">
                        <tr>
                            <th><h3>Titulo</h3></th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($posts as $post)
                            <tr>
                            <td>{{$post->title}}</td>
                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Editar</a></td>
                            <td>
                                {!!Form::open(['action'=>['PostsController@destroy', $post->id], 'metod' => 'POST', 'class'=> 'pull-right']) !!}
                                {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Eliminar',['class' => 'btn btn-danger'])}}
                                {!!Form::close()!!}
                            
                            </td>
                        </tr>

                        @endforeach
                    @else
                        <p>Aun no tienes Posts</p>    
                    @endif
                    </table>


            <!--        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                  

                    You are logged in!   @endif -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
