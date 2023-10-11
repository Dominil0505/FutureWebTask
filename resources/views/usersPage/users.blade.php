@extends('layout.layout')
@section('content')
    <div class="mb-3">
        <h1 class="header text-white"> Felhasználók </h1>
    </div>

    <div class="container py-2">
        <div class="row justify-content-center align-items-center ">
            @foreach ($allUsers as $user)
                <div class="col-md-10 col-xl-4 mb-3">
                    <div class="card" style="border-radius: 15px;">
                        <div class="card-body text-center">
                            <div class="mt-3 mb-4">
                                <i class="fa-solid fa-user fa-2xl"></i>
                            </div>
                            <h4 class="mb-2"><a href="users/post/{{ $user->name }}">{{ $user->name }}</a></h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
