@extends('layouts.app')
    @section('content')
    <a href="/tests" class="btn">Back</a>
                <h3>{{$test->title}}</h3>
                <p><b>{{$test->question}}</b></p>
                <p>{{$test->answer}}</p>
                <small>Created on {{$test->created_at}}</small>
    @endsection