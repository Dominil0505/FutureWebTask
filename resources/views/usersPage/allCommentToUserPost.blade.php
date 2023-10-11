@extends('layout.layout')
@section('content')

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
@endsection
