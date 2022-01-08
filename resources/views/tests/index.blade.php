@extends('layouts.app')
    @section('content')
    @if(count($tests) > 1)
        @foreach($tests as $test)
            <div class="well">
                <h3><a href="/tests/{{$test->id}}">{{$test->title}}<a></h3>
            </div>
        @endforeach
        {{$tests->links()}}
    @else
        <p>No tests</p>
    @endif
    @endsection

    