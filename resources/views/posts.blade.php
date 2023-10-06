@extends('layout')
@section('content')
    <div class="p-3 mb-5">
        <h1> Posztjaim </h1>
        <a href="createPost" class="btn btn-success">Poszt hozzáadása</a>

        <ul class="list-group list-group-flush">
            @foreach ($allOurPost as $post)
            <li class="list-group-item">{{ $post->title  }}</li>
            @endforeach
        </ul>
    </div>
@endsection
