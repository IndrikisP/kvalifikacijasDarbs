@extends('layouts.app')
    @section('content')
    @if(count($countries) > 0)
    <div style="text-align:center;margin-top:20px;">
    <h3>Correct Answers</h3>
    <br>
        @foreach($countries as $key => $value)
          <img
        src="https://flagcdn.com/w320/{{$key}}.png"
        srcset="https://flagcdn.com/w640/{{$key}}.png 2x"
        width="320"
        alt="">
        <br>
        <p style="color:red;">{{$value}}</p>
            <hr>
        @endforeach
    </div>
    @else
        <p>You have guessed every country flag correctly</p>
    @endif
    @endsection