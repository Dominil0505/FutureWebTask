@extends('layout')
@section('content')
    <div class="p-4 mb-5 mt-5 text-white rounded-bg">
        <h1> Felhasználók </h1>
        <table class="table text-white">
            <thead>
                <tr>
                    <th>Név</th>
                    <th>Posztok száma</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allUsers as $user)
                    <tr>
                        <td>
                            <a href="" class="text-white">{{ $user->name }}</a>
                        </td>

                        <td>
                            <span class="badge bg-primary rounded-pill">2</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
