@extends('layout')
@section('content')
    <div class="p-2 mb-3 mt-2">
        <h1> Felhasználók </h1>
    </div>

        @foreach ($allUsers as $user)
            <div class="card mb-3">
                <div class="card-body">
                   <a href="users/post/{{ $user->name }}">{{ $user->name }}</a>
                </div>
            </div>
        @endforeach

@endsection
