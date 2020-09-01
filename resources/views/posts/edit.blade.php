@extends('layouts/app')

@section('content')
    <div class="container">
    <h1>Edit Post</h1>

    {!! Form::open(['action'=>['PostController@update',$data[0]->id],'method'=>'put','enctype'=>'multipart/form-data']) !!}
    
        <div class="form-group">
            {{Form::label('title','Title')}}
            {{Form::text('title',$data[0]->title,['class'=>'form-control','placeholder'=>'Enter Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body','Body')}}
            {{Form::textarea('body',$data[0]->body,['class'=>'form-control','placeholder'=>'Write your post here'])}}  
        </div>
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>
        {{Form::submit('Post',['class'=>'btn btn-primary'])}}    
    {!! Form::close() !!}
    </div>
@endsection 