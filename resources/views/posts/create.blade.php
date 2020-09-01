@extends('layouts/app')

@section('content')
    <div class="container"> 
    <h1>Create Posts</h1>
<!--    <form method="POST" action={{ action('PostController@store') }}>
        <label for="create-title">Title</label>
        <input type="text" class="form-control" id="create-title" placeholder="Enter title of your post">

        <label for="create-body">Body</label>
        <textarea rows="10" cols="50" class="form-control" id="create-body" placeholder="Write your post here"></textarea>

        <button type="submit" style="margin: 1rem" type="button" class="btn btn-primary">Post</button>
    </form> -->

    {!! Form::open(['action'=>'PostController@store','method'=>'post','enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title','',['class'=>'form-control','placeholder'=>'Enter Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Write your post here'])}}  
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Post',['class'=>'btn btn-primary'])}}    
    {!! Form::close() !!}
    </div>
@endsection