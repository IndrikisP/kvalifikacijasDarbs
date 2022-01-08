@extends('layouts.app')
    @section('content')
    <h1>Create Post</h1>
    {{ Form::open(array('url' => 'foo/bar')) }}
   {{Form::label('question', 'E-Mail Address')}}
   {{Form::text('question', '')}}
{{ Form::close() }}
    @endsection

    