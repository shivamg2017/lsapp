@extends('layouts/app')

@section('content')
    @if (count($data) > 0)
    <div class="container">
        @foreach ($data as $item)
            <h1>{{$item->title}}</h1>
            <hr>
            <small>Written on {{$item->created_at}}</small><br>
            <small>Last updated on {{$item->updated_at}}</small>
            <hr>
            <img style="width: 20%" src="/storage/cover_images/{{$item->cover_image}}">
            <div>
                <p style="font-size: 2rem">{!! $item->body !!}</p>
            </div>
            <hr>
            @if (!Auth::guest() and Auth::user()->id == $item->user_id)
                
            <a href="/posts/{{$item->id}}/edit" class="btn btn-default">Edit Post</a>
            
            {!!Form::open(['action'=>['PostController@destroy',$item->id],'method'=>'delete','class'=>'pull-right'])!!}
                {{ Form::submit('Delete',['class'=>'btn btn-danger']) }}
            {!! Form::close() !!}
            @endif
        @endforeach
    </div>
    @endif       
@endsection