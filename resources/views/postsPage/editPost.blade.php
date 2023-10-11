@extends('layout.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-sm-5">
                <div class="card mb-3 mt-3">
                    <div class="card-header bg-primary text-white">Poszt Módosítása</div>
                    <div class="card-body">
                        <form action="{{ $post->post_id }}" method="POST">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="text" class="form-label">Poszt címe</label>
                                <input type="text" value="{{ $post->title }}" class="form-control" id="post_title"
                                    name="post_title">
                            </div>
                            <div class="mb-3">
                                <label for="text" class="form-label">Poszt tartalma</label>
                                <input type="text" value="{{ $post->content }}" id="content" name="content" class="form-control">
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
