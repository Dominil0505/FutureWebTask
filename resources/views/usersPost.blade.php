@extends('layout')
@section('content')
    <div class="p-2 mb-3 mt-2">
        <h1> {{ $user->name }} Posztjai</h1>
    </div>
    @foreach ($ourPost as $post)
        <div class="list-group">
            <a href="{{ $post->title }}" class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">

                    <h5 class="mb-1">{{ $post->title }}</h5>
                    <small>3 nap</small>
                </div>
            </a>
        </div>
    @endforeach
@endsection
