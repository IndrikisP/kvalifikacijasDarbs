@extends('layouts.app')
    @section('content')
    <h1>{{$title}}</h1>    
    @if(count($descriptions) > 0)
        @foreach($descriptions as $description)
        <p>{{$description}}</p>
        @endforeach
    @endif
    @endsection

    