@extends('layout')
@section('content')
    <ul class="list-group">
        @foreach ($allUsers as $user)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="" class="link-primary">{{ $user->name }}</a>
                <span class="badge bg-primary rounded-pill">2</span>
            </li>
        @endforeach
    </ul>
@endsection
