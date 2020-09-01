@extends('layouts/app')

@section('content')
    <div class="container">
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col col-sm-4">
                        <img style="width: 100%" src="/storage/cover_images/{{$post->cover_image}}">
                    </div>
                    <div class="col-md-4 col col-sm-4">
                        <a href="posts/{{$post->id}}"><h1>{{$post->title}}</h1></a>
                        <h6>Updated At {{$post->updated_at}}</h6>
                    </div>    
                </div>
            </div>
        </div>
        @endforeach
        {{ $posts->links() }}

    @else
        <p>No Posts Found...</p>
    @endif
    </div>
@endsection