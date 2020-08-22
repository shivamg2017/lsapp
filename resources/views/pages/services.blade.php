@extends('layouts/app')

@section('content')
    <h1>Laravel Services</h1>
    <h3>{{$title}}</h3>
    @if (count($service) > 0)
        <ol class="list-group">
            @foreach ($service as $serv)
                <li class="list-group-item">{{$serv}}</li>
            @endforeach
        </ol>
    @endif
@endsection
        

