@extends('layout')
@section('content')
    <div class="p-2 mb-3 mt-2">
        <h1> Posztjaim </h1>
        <a href="createPost" class="btn btn-success mb-3">Poszt hozzáadása</a>
    </div>

    <div class="list-group">
        @foreach ($allOurPost as $post)
            <a href="posts/{{ $post->title }}" class="list-group-item list-group-item-action" aria-current="true">
                <div class="d-flex w-100 justify-content-between">

                    <h5 class="mb-1">{{ $post->title }}</h5>
                    <small>3 nap</small>
                </div>
            </a>
        @endforeach
    </div>

@endsection
