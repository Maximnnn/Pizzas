@extends('layouts.app')

@section('content')

    <pizza :pizza='@json($pizza)' :ingredients='@json($ingredients)'></pizza>

@endsection
