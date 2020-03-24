@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
        @foreach($pizzas as $pizza)
            <div class="col-md-4 card">

                <div class="card-header">
                    <a href="/pizza/{{$pizza->id}}">{{$pizza->name}}</a> - {{$pizza->price}}
                </div>

                <div class="card-body">

                </div>

            </div>
        @endforeach
        </div>


    </div>

@endsection
