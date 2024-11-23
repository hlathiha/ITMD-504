
@extends('layouts.app')

@section('content')
    <h1>Welcome, {{ auth()->user()->name }}</h1>
    <a href="{{ url('/meeting') }}">Join a Meeting</a>
@endsection
