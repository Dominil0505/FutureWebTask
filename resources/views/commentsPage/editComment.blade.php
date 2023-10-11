@extends('layout.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-5">
                <div class="card mb-3 mt-3">
                    <div class="card-header bg-primary text-white">Komment Módosítása</div>
                    <div class="card-body">
                        <form action="{{ $comment->comment_id }}" method="POST">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="text" class="form-label">Kommenthez tartozó poszt</label>
                                <input type="text" value="{{ $comment->post->title }}" class="form-control" readonly>
                                <input type="text" value="{{ $comment->comment_id }}" id="comment_id" name="comment_id"
                                    hidden>
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Komment tartalma</label>
                                <textarea name="content" id="content" class="form-control">{{ $comment->content }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Változtatás</button>
                        </form>
                    </div>
                </div>
                @if (session('updated'))
                    <div class="alert alert-success">
                        {{ session('updated') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
