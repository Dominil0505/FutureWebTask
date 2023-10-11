@extends('layout.layout')
@section('content')
    <div class="p-3 mb-5 ">
        <div class="col-sm-4">
            <form action="createPost" method="POST">
                @csrf
                <div class="mb-3 mt-3">
                    <label for="title" class="form-label ">Poszt cím</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Poszt tartalma:</label>
                    <textarea name="content" id="content" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary mb-4">Posztolás</button>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection
