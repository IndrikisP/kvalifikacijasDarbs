@extends('layouts.app')
    @section('content')
    <h1>{{$title}}</h1>
    <p><a class="btn btn-primary btn-lg" herf="/login" role="button">Login</a><a class="btn btn-success btn-lg" herf="/register" role="button">Register</a></p>
    @endsection