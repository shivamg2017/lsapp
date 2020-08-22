@extends('layouts/app');

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="well" style="background-color: skyblue">
                <h1>{{$post->title}}</h1>
                <h4>{{$post->body}}</h4>
            </div>
        @endforeach

    @else
        <p>No Posts Found...</p>
    @endif
@endsection