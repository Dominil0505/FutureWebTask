@extends('layout.layout')
@section('content')
    <div class="mb-3">
        <h1 class="header text-white"> Posztjaim </h1>
    </div>
    <div class="m-3">
        <a href="createPost" class="btn btn-success mb-3">Poszt hozzáadása</a>
    </div>

    <div class="container py-2">
        <div class="row justify-content-center align-items-center">
            @foreach ($allOurPost as $post)
                <div class="col-md-10 col-xl-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><a href="posts/{{ $post->title }}"
                                    class="link-dark">{{ $post->title }}</a></h5>
                            <a href="posts/edit/{{ $post->post_id }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <a href="posts/delete/{{ $post->post_id }}" class="btn btn-danger"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
@endsection
