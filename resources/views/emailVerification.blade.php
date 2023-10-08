@extends('layout')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <h1>Email cím visszaigazolás</h1>
        </div>
    </div>
    <a href="http://127.0.0.1:8000/account/verify/{{ $token }}" class="m-3 btn btn-primary">Email visszaigazolás</a>
@endsection
