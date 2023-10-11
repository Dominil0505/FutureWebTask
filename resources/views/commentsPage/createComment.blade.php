@extends('layout.layout')
@section('content')
    <div class="p-3 mb-5 ">
        <div class="col-sm-4">
            <form action="createCommentPost" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="content" class="form-label">Komment tartalma:</label>
                    <textarea name="content" id="content" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="post_id" name="post_id">
                        <option selected>Válassz a posztok közül</option>
                        @foreach ($posts as $post)
                            <option value="{{ $post->post_id }}">{{ $post->title }} - {{ $post->user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-4">Mentés</button>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
