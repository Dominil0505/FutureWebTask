@extends('layout')
@section('content')
    <div class="p-4 mb-5 mt-5 text-white rounded-bg">
        <h1 class="text-white"> Posztjaim </h1>
        <a href="createPost" class="btn btn-success mb-3">Poszt hozzáadása</a>

        <table class="table text-white">
            <thead>
                <tr>
                    <th>Poszt Neve</th>
                    <th>Törlés</th>
                    <th>Szerkesztés</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allOurPost as $post)
                    <tr>
                        <td>{{ $post->title }}</td>
                        <td><a href="" class="btn btn-danger">Törlés</a></td>
                        <td><a href="" class="btn btn-primary">Szerkesztés</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
