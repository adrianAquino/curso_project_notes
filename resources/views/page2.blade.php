@extends('layouts.main_layout')
    @section('content')
    <h1>Hello from Blade Template</h1>
    <hr>
    <h2>Page 2</h2>
    <h3>The value is: {{ $value }}</h3>
@endsection