@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    <br>
                    <a href="posts/create" class="btn btn-primary">Create a post</a>
                </div>
            </div>
            <br>
            <h3>Your Posts</h3>
            <table class="table">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Title</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($list as $item)
                    <tr>
                        <th scope="row">{{$item->updated_at}}</th>
                        <td><a href="posts/{{$item->id}}">{{$item->title}}</a></td>
                        <td><a href="posts/{{$item->id}}/edit" class="btn btn-default">Edit</a></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection
