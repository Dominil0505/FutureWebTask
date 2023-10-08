@extends('layout')
@section('content')
    <div class="p-2 mb-3 mt-2">
        <h1> Kommentek </h1>
        <a href="createComment" class="btn btn-success mb-3">Komment hozzáadása</a>
    </div>

    @if (!empty($comments))
        <div class="row">
            @foreach ($comments as $comment)
                <div class="col-sm-3">
                    <div class="card m-3" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $comment->post->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $comment->user->name }}</h6>
                            <p class="card-text">{{ $comment->content }}</p>
                            <p class="card-text">Létrehozva: {{ $comment->created_at }}</p>
                            <a href="comments/edit/{{ $comment->comment_id }}" class="btn btn-primary">Szerkesztés</a>
                            <a href="comments/delete/{{ $comment->comment_id }}" class="btn btn-danger">Törlés</a>
                        </div>
                    </div>
                </div>
            @endforeach
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
