@extends('layout.layout')
@section('content')
    <div class="mb-3">
        <h1 class="header text-white"> Kommentek </h1>
    </div>

    <div class="m-3">
        <a href="createComment" class="btn btn-success mb-3">Komment hozzáadása</a>
    </div>

    @if (!empty($comments))
        <div class="container py-2">
            <div class="row justify-content-center align-items-center">
                @foreach ($comments as $comment)
                    <div class="col-md-10 col-xl-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $comment->post->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h6>
                                <p class="card-text">{{ $comment->content }}</p>
                                <p class="card-text">Létrehozva: {{ $comment->created_at }}</p>
                                <a href="comments/edit/{{ $comment->comment_id }}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                <a href="comments/delete/{{ $comment->comment_id }}" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        @if (session('empty'))
            <div class="alert alert-danger">
                {{ session('empty') }}
            </div>
        @endif
    @endif

    @if (session('delete'))
        <div class="alert alert-danger">
            {{ session('delete') }}
        </div>
    @endif

@endsection
