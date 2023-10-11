@extends('layout.layout')
@section('content')
    <h1 class="header text-white"> {{ $user->name }} Posztjai</h1>


    @foreach ($ownPost as $post)
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div class="ms-2 me-auto">
                    <div class="fw-bold"><a
                            href="/users/post/{{ $post->user->name }}/{{ $post->title }}">{{ $post->title }}</a></div>
                </div>
            </li>
        </ul>
    @endforeach
@endsection
